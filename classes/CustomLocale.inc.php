<?php

/**
 * @file plugins/generic/customLocale/classes/CustomLocale.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocale
 */

class CustomLocale extends DataObject {
	//
	// Get/set methods
	//
	function getKey(){
		return $this->getData('key');
	}

	function setKey($key) {
		return $this->setData('key', $key);
	}

	function getLocale(){
		return $this->getData('locale');
	}

	function setLocale($locale) {
		return $this->setData('locale', $locale);
	}

	function getContextId(){
		return $this->getData('contextId');
	}

	function setContextId($contextId) {
		return $this->setData('contextId', $contextId);
	}

	function setFileTitle($title) {
		return $this->setData('filetitle', $title);
	}

	function getFileTitle() {
		return $this->getData('filetitle');
	}

	function setTitle($title, $locale) {
		return $this->setData('title', $title, $locale);
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
		return $this->setData('path', $path);
	}

	function getFilePath() {
		return $this->getData('filepath');
	}

	function setFilePath($filepath) {
		return $this->setData('filepath', $filepath);
	}
}

