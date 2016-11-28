<?php

/**
 * @file plugins/generic/customLocale/controllers/grid/CustomLocaleGridCellProvider.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class CustomLocaleGridCellProvider
 */

import('lib.pkp.classes.controllers.grid.GridCellProvider');
import('lib.pkp.classes.linkAction.request.RedirectAction');

class CustomLocaleGridCellProvider extends GridCellProvider {

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
	}

	/**
	 * Get cell actions associated with this row/column combination
	 * @param $row GridRow
	 * @param $column GridColumn
	 * @return array an array of LinkAction instances
	 */
	function getCellActions($request, $row, $column, $position = GRID_ACTION_POSITION_DEFAULT) {
		$customLocale = $row->getData();
		import('lib.pkp.classes.linkAction.request.RemoteActionConfirmationModal');
		import('lib.pkp.classes.linkAction.request.AjaxAction');
		import('lib.pkp.classes.linkAction.request.AjaxModal');
		switch ($column->getId()) {
			case 'path':
				$dispatcher = $request->getDispatcher();
				$router = $request->getRouter();

				return array(new LinkAction(
					'edit',
					new AjaxAction(	
						$router->url($request, null, null, 'edit', null, array('localeKey' => $customLocale->getPath()))
					),					
					'edit',
					null
				));

			case 'filepath':
				$dispatcher = $request->getDispatcher();
				$router = $request->getRouter();

				return array(new LinkAction(
					'edit',
					new AjaxModal(
						$router->url($request, null, null, 'editLocaleFile', null, array('locale'=>$customLocale->getLocale(),'filePath' =>  $customLocale->getFilePath())),
						__('grid.action.edit'),
						'modal_edit',
						true
					),				
					'EDIT',
					null
				));
			default:
				return parent::getCellActions($request, $row, $column, $position);
		}
	}

	/**
	 * Extracts variables for a given column from a data element
	 * so that they may be assigned to template before rendering.
	 * @param $row GridRow
	 * @param $column GridColumn
	 * @return array
	 */
	function getTemplateVarsFromRowColumn($row, $column) {
		$customLocale = $row->getData();

		switch ($column->getId()) {
			case 'path':
				// The action has the label
				return array('label' => '');
			case 'filepath':
				// The action has the label
				return array('label' => '');
			case 'title':
				return array('label' => $customLocale->getLocalizedTitle());
			case 'filetitle':
				return array('label' => $customLocale->getFileTitle());
			case 'key':
				return array('label' => $customLocale->getKey());
		}
	}
}

?>
