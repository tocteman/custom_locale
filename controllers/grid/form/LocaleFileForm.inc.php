<?php

/**
 * @file plugins/generic/customLocale/controllers/grid/form/LocaleFileForm.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class LocaleFileForm
 */

import('lib.pkp.classes.form.Form');

class LocaleFileForm extends Form {

	var $contextId;

	var $filePath;

	var $locale;

	/** Custom locale plugin */
	var $plugin;

	/**
	 * Constructor
	 * @param $customLocalePlugin object
	 * @param $contextId int Context ID
	 * @param $filePath string
	 * @param $locale string
	 */
	function __construct($customLocalePlugin, $contextId, $filePath, $locale) {
		parent::__construct($customLocalePlugin->getTemplatePath() . 'localeFile.tpl');
		$this->filePath = $filePath;
		$this->locale = $locale;

		$this->plugin = $customLocalePlugin;
	}

	/**
	 * @see Form::fetch
	 */
	function fetch($request,$currentPage=0,$searchKey='',$searchString='') {
		
		$file =  $this->filePath;		
		$locale = $this->locale;

		$templateMgr =& TemplateManager::getManager();

		import('lib.pkp.classes.file.FileManager');
		$fileManager = new FileManager();

		import('lib.pkp.classes.file.EditableLocaleFile');
		$press = Request::getPress();
		$pressId = $press->getId();


		$publicFilesDir = Config::getVar('files', 'public_files_dir');
		$customLocaleDir = $publicFilesDir . DIRECTORY_SEPARATOR . 'presses' . DIRECTORY_SEPARATOR . $pressId . DIRECTORY_SEPARATOR . CUSTOM_LOCALE_DIR;
		$customLocalePath = $customLocaleDir . DIRECTORY_SEPARATOR . $locale . DIRECTORY_SEPARATOR . $file;

		if ($fileManager->fileExists($customLocalePath)) {
			$localeContents = EditableLocaleFile::load($customLocalePath);

		} else {
			$localeContents = null;
		}

		if (!CustomLocaleAction::isLocaleFile($locale, $file)) {

		} else {

		}

		$referenceLocaleContents = EditableLocaleFile::load($file);
		$referenceLocaleContentsRangeInfo = Handler::getRangeInfo($request,'referenceLocaleContents');

		$numberOfItemsPerPage = 30;
		$numberOfPages = ceil(sizeof($referenceLocaleContents) / $numberOfItemsPerPage);

		if ($searchKey) {

			$keysReferenceLocaleContents = array_keys($referenceLocaleContents);
			$keyPosition = array_search($searchString, $keysReferenceLocaleContents); 

			if ($keyPosition==0) {
				$currentPage = 1;
			}

			if ($keyPosition>0) {
				$currentPage = floor($keyPosition/$numberOfItemsPerPage)+1;
			}

		}

		// set page number, default: go to first page
		if (!$currentPage){
			$currentPage=1;
		}

		$dropdownEntries = array();
		for ($i=1; $i<=$numberOfPages; $i++) {
			if ($i==$currentPage) {
				$dropdownEntries[$i] = "stay on page " . $i;
			} else {
				$dropdownEntries[$i] = "go to page " . $i;
			}

		}

		$templateMgr->assign('filePath', $this->filePath);
		$templateMgr->assign('localeContents', $localeContents);
		$templateMgr->assign('locale', $locale);
		$templateMgr->assign('currentPage',$currentPage);
		$templateMgr->assign('dropdownEntries',$dropdownEntries);
		$templateMgr->assign('searchString',$searchString);

		import('lib.pkp.classes.core.ArrayItemIterator');

		$templateMgr->assign_by_ref('referenceLocaleContents', new ArrayItemIterator($referenceLocaleContents,$currentPage, $numberOfItemsPerPage));

		return parent::fetch($request);
	}

}

?>
