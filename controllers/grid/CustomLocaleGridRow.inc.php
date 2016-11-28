<?php

/**
 * @file plugins/generic/customLocale/controllers/grid/CustomLocaleGridRow.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocaleGridRow
 */

import('lib.pkp.classes.controllers.grid.GridRow');

class CustomLocaleGridRow extends GridRow {

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
	}

	//
	// Overridden template methods
	//
	/**
	 * @copydoc GridRow::initialize()
	 */
	function initialize($request) {
		parent::initialize($request);

		$customLocaleId = $this->getId();
		if (!empty($customLocaleId)) {
			$router = $request->getRouter();
		}
	}
}

?>
