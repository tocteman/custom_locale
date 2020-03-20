<?php

/**
 * @file controllers/grid/form/LocaleFileForm.inc.php
 *
 * Copyright (c) 2016-2020 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class LocaleFileForm
 */

import('lib.pkp.classes.form.Form');

class LocaleFileForm extends Form {
	/** @var $filePath string */
	var $filePath;

	/** @var $locale string */
	var $locale;

	/** Custom locale plugin */
	var $plugin;

	/**
	 * Constructor
	 * @param $customLocalePlugin object
	 * @param $filePath string
	 * @param $locale string
	 */
	function __construct($customLocalePlugin, $filePath, $locale) {
		parent::__construct($customLocalePlugin->getTemplateResource('localeFile.tpl'));
		$this->plugin = $customLocalePlugin;
		$this->filePath = $filePath;
		$this->locale = $locale;
	}

	/**
	 * @copydoc Form::fetch
	 * @param $currentPage int
	 * @param $searchKey string
	 * @param $searchString string
	 */
	function fetch($request, $currentPage=0, $searchKey='', $searchString='') {
		$file = $this->filePath;
		$locale = $this->locale;
		if (!CustomLocaleAction::isLocaleFile($locale, $file)) throw new Exception("$file is not a locale file!");

		$contextFileManager = new ContextFileManager($request->getContext()->getId());
		$customLocalePath = $contextFileManager->getBasePath() . "customLocale/$locale/$file";

		import('lib.pkp.classes.i18n.LocaleFile');
		if ($contextFileManager->fileExists($customLocalePath)) $localeContents = LocaleFile::load($customLocalePath);
		else $localeContents = null;
		$referenceLocaleContents = LocaleFile::load($file);
		$referenceLocaleContentsArray = [];
		foreach ($referenceLocaleContents as $key => $value) {
			$referenceLocaleContentsArray[] = [
				'localeKey' => $key,
				'value' => $value,
			];
		}


		$dropdownEntries = array();
		for ($i=1; $i<=$numberOfPages; $i++) {
			if ($i==$currentPage) {
				$dropdownEntries[$i] = "stay on page " . $i;
			} else {
				$dropdownEntries[$i] = "go to page " . $i;
			}
		}

		import('lib.pkp.classes.core.ArrayItemIterator');
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign(array(
			'filePath' => $this->filePath,
			'localeContents' => $localeContents,
			'locale' => $locale,
			'referenceLocaleContentsArray' => $referenceLocaleContentsArray,
			'currentPage' => $currentPage,
			'dropdownEntries' => $dropdownEntries,
			'searchString' => $searchString,
		));

		return parent::fetch($request);
	}
}

