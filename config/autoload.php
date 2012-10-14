<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Vcard
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Contao\ContentVCard' => 'system/modules/vcard/classes/ContentVCard.php',
	'Contao\vcard'        => 'system/modules/vcard/classes/vcard.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_vcard' => 'system/modules/vcard/templates',
));
