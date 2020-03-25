var customLocalesApp = {};
$(function() {
	customLocalesApp = {
		el: '#customLocales',
		data: {
			edited: {},
			filePath: '',
			localEdited: {}, // temporarily holds edited values, both saved and new
			localeKeysMaster: [], // master list of all keys in locale file
			filteredKeysList: [], // filtered keys allows for paginating search results
			currentLocaleKeys: [], // keys available on a given page
			searchPhrase: '',
			currentPage: 0,
			itemsPerPage: 50,
			displaySearchResults: false,
		},
		methods: {
			search: function() {
				if (!this.searchPhrase) {
					this.initializeView();
					return;
				}

				this.displaySearchResults = true;
				this.currentPage = -1;
				var filteredKeysList = [];
				for (var i in this.localeKeysMaster) {
					if (new RegExp(this.searchPhrase, 'i' ).test(this.localeKeysMaster[i].localeKey)
							|| new RegExp(this.searchPhrase, 'i' ).test(this.localeKeysMaster[i].value)) {
								filteredKeysList.push({
							localeKey: this.localeKeysMaster[i].localeKey,
							value: this.localeKeysMaster[i].value,
						});
					}
				}
				
				// Similar to initializeView, but uses search results rather than master list
				this.currentPage = 1;
				var end = this.currentPage * this.itemsPerPage;
				var start = end - this.itemsPerPage;
				this.filteredKeysList = filteredKeysList;
				this.currentLocaleKeys = this.filteredKeysList.slice(start,end);
			},
			initializeView: function() {
				this.searchPhrase = "";
				this.currentPage = 1;
				this.displaySearchResults = false;

				this.filteredKeysList = this.localeKeysMaster; // Filtering changes
				var end = this.currentPage * this.itemsPerPage;
				var start = end - this.itemsPerPage;
				this.currentLocaleKeys = this.filteredKeysList.slice(start,end);
			}
		},
		computed: {
			maxPages: function() {
				if (!this.filteredKeysList.length) {
					return 0;
				}
				return Math.ceil(this.filteredKeysList.length / this.itemsPerPage);
			}
		},
		watch: {
			currentPage: function(newVal, oldVal) {
				if (newVal === oldVal) {
					return;
				}
				var end = newVal * this.itemsPerPage;
				var start = end - this.itemsPerPage;
				this.currentLocaleKeys = this.filteredKeysList.slice(start, end); // Filtering changes

			}
		},
		mounted: function() {
			this.initializeView();
			// merges edited into localEdited
			this.localEdited = {} // TODO: Should all changes be cleared when searching?
			for (var attrName in this.edited) {
				this.localEdited[attrName] = this.edited[attrName];
			}
		},
	};
});