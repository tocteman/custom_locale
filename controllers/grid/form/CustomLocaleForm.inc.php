<?php

/**
 * @file plugins/generic/customLocale/controllers/grid/form/CustomLocaleForm.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocaleForm
 */

import('lib.pkp.classes.form.Form');

class CustomLocaleForm extends Form {

	var $localeFiles;
	var $locales;
	/** Custom locale plugin */
	var $plugin;

	/**
	 * Constructor
	 * @param $template string Filename of template to display
	 */
	function __construct($template) {
		parent::__construct($template);
	}

	function setLocales($locales) {
		$this->locales = $locales;
	}

	function setLocaleFiles($localeFiles) {				
		$this->localeFiles = $localeFiles;
	
	}

	function fetch($request, $template = null, $display = false) {

		// Set custom template.
		if (!is_null($template)) $this->_template = $template;

		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->setCacheability(CACHEABILITY_NO_STORE);

		// custom locale specific data
		$templateMgr->assign('locales',$this->locales);
		$templateMgr->assign('localeFiles',$this->localeFiles);
		$templateMgr->assign('masterLocale', MASTER_LOCALE);

		$templateMgr->assign($this->_data);

		$templateMgr->register_function('form_language_chooser', array($this, 'smartyFormLanguageChooser'));
		$templateMgr->assign('formLocales', $this->supportedLocales);

		// Determine the current locale to display fields with
		$templateMgr->assign('formLocale', $this->getFormLocale());

		$returner = $templateMgr->display($this->_template, null, null, $display);

		return $returner;
	}

}

?>
