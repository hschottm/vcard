<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['files']['vcard'] = 'ContentVCard';

$GLOBALS['TL_CONFIG']['urlKeywords'] .= (strlen(trim($GLOBALS['TL_CONFIG']['urlKeywords'])) ? ',' : '') . 'vcard';

//
// configuration settings for vcard export
//

// Default type of contao phone number, for values see: Communication values for the TEL type in vcard.php

$GLOBALS['TL_CONFIG']['vcard']['phonetype'] = 1;

?>