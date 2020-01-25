<?php

/**
 * @file classes/CustomLocale.inc.php
 *
 * Copyright (c) 2016-2020 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocale
 */

class CustomLocale extends DataObject {
	//
	// Get/set methods
	//
	function getKey() {
		return $this->getData('key');
	}

	function setKey($key) {
		$this->setData('key', $key);
	}

	function getLocale() {
		return $this->getData('locale');
	}

	function setLocale($locale) {
		$this->setData('locale', $locale);
	}

	function getContextId() {
		return $this->getData('contextId');
	}

	function setContextId($contextId) {
		$this->setData('contextId', $contextId);
	}

	function setFileTitle($title) {
		$this->setData('filetitle', $title);
	}

	function getFileTitle() {
		return $this->getData('filetitle');
	}

	function setTitle($title, $locale) {
		$this->setData('title', $title, $locale);
	}

	function getTitle($locale) {
		return $this->getData('title', $locale);
	}

	function getLocalizedTitle() {
		return $this->getLocalizedData('title');
	}

	function getPath() {
		return $this->getData('path');
	}

	function setPath($path) {
		$this->setData('path', $path);
	}

	function getFilePath() {
		return $this->getData('filepath');
	}

	function setFilePath($filepath) {
		$this->setData('filepath', $filepath);
	}
}

