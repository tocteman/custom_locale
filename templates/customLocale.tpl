{**
 * plugins/generic/customLocale/templates/customLocale.tpl
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 *}

{url|assign:customLocaleGridUrl router=$smarty.const.ROUTE_COMPONENT component="plugins.generic.customLocale.controllers.grid.CustomLocaleGridHandler" op="fetchGrid" state="start" escape=false}

{load_url_in_div id="customLocaleGridContainer" url=$customLocaleGridUrl}


