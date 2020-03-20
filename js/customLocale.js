var customLocalesApp = {};
$(function() {
	customLocalesApp = {
		el: '#customLocales',
		data: {
			edited: {},
			localeKeys: [],
			currentLocaleKeys: [],
			searchPhrase: '',
			currentPage: 0,
			itemsPerPage: 50,
		},
		methods: {
			search: function() {
				if (!this.searchPhrase) {
					return;
				}
				this.currentPage = 1;
				var currentLocaleKeys = [];
				for (var i in this.localeKeys) {
					if (new RegExp(this.searchPhrase, 'i' ).test(this.localeKeys[i].localeKey)
							|| new RegExp(this.searchPhrase, 'i' ).test(this.localeKeys[i].value)) {
						currentLocaleKeys.push({
							localeKey: this.localeKeys[i].localeKey,
							value: this.localeKeys[i].value,
						});
					}
				}
				this.currentLocaleKeys = currentLocaleKeys;
			}
		},
		computed: {
			maxPages: function() {
				if (!this.localeKeys.length) {
					return 0;
				}
				return Math.ceil(this.localeKeys.length / this.itemsPerPage);
			}
		},
		watch: {
			currentPage: function(newVal, oldVal) {
				if (newVal === oldVal) {
					return;
				}
				var end = newVal * this.itemsPerPage;
				var start = end - this.itemsPerPage;
				this.currentLocaleKeys = this.localeKeys.slice(start, end);
			}
		},
		mounted: function() {
			this.currentPage = 1;
		},
	};
});