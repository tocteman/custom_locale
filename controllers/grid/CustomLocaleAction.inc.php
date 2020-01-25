<?php

/**
 * @file controllers/grid/CustomLocaleAction.inc.php
 *
 * Copyright (c) 2016-2020 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocaleAction
 */

class CustomLocaleAction {
	/**
	 * Get a list of locale files.
	 * @param $locale
	 * @return array
	 */
	static function getLocaleFiles($locale) {
		if (!AppLocale::isLocaleValid($locale)) return null;

		$localeFiles = AppLocale::makeComponentMap($locale);
		$plugins = PluginRegistry::loadAllPlugins();

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

	/**
	 * Determine whether a specified file is a locale file.
	 * @param $locale string
	 * @param $filename string
	 * @return boolean
	 */
	static function isLocaleFile($locale, $filename) {
		if (in_array($filename, self::getLocaleFiles($locale))) return true;
		return false;
	}

}

