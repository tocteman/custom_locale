<?php

/**
 * @file plugins/generic/customLocale/controllers/grid/CustomLocaleAction.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocaleAction
 */


class CustomLocaleAction {

	function getLocaleFiles($locale) {
		if (!AppLocale::isLocaleValid($locale)) return null;

		$localeFiles =& AppLocale::makeComponentMap($locale);
		$plugins =& PluginRegistry::loadAllPlugins();

		foreach (array_keys($plugins) as $key) {

			$plugin =& $plugins[$key];
			$localeFile = $plugin->getLocaleFilename($locale);
			$localeFilePath = $localeFile[0];

			if (file_exists($localeFilePath)) {
				if (!empty($localeFile)) {
					if (is_scalar($localeFile)) {
						$localeFiles[] = $localeFile;
					}
					if (is_array($localeFile)) {
						$localeFiles = array_merge($localeFiles, $localeFile);
					} 
				}
			} 
			unset($plugin);
		}
		return $localeFiles;
	}

	function isLocaleFile($locale, $filename) {
		if (in_array($filename, CustomLocaleAction::getLocaleFiles($locale))) return true;
		return false;
	}

}
?>
