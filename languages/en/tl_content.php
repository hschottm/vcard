<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Content elements
 */
$GLOBALS['TL_LANG']['tl_content']['vcard_type']  = array('Show for', 'Please select a target group to pick up a person.');
$GLOBALS['TL_LANG']['tl_content']['vcard_member']  = array('Member', 'Please select the frontent member whose vCard should be shown.');
$GLOBALS['TL_LANG']['tl_content']['vcard_http']  = array('HTTP parameter', 'Please enter a HTTP GET or HTTP POST parameter which can be used to extract the ID of a member. If the parameter exists during the script runtime, TYPOlight extracts the member ID from the parameter.');
$GLOBALS['TL_LANG']['tl_content']['vcard_type']['vmember']  = 'Members';
$GLOBALS['TL_LANG']['tl_content']['vcard_type']['vhttp']  = 'HTTP parameter';
$GLOBALS['TL_LANG']['tl_content']['vcard_type']['vcustom']  = 'Custom input';
$GLOBALS['TL_LANG']['tl_content']['vcard_title'] = 'Download vCard';
$GLOBALS['TL_LANG']['tl_content']['vc_title']   = array('Title', 'Please enter the the title.');
$GLOBALS['TL_LANG']['tl_content']['vc_firstname']   = array('First name', 'Please enter the first name.');
$GLOBALS['TL_LANG']['tl_content']['vc_lastname']    = array('Last name', 'Please enter the last name.');
$GLOBALS['TL_LANG']['tl_content']['vc_birthday'] = array('Date of birth', 'Please enter the date of birth.');
$GLOBALS['TL_LANG']['tl_content']['vc_company']     = array('Company', 'Here you can enter a company name.');
$GLOBALS['TL_LANG']['tl_content']['vc_department'] = array('Department', 'Please enter the department title.');
$GLOBALS['TL_LANG']['tl_content']['vc_jobtitle'] = array('Job title', 'Please enter the job title.');
$GLOBALS['TL_LANG']['tl_content']['vc_box_work']      = array('P.O. Box', 'Please enter the P.O. Box.');
$GLOBALS['TL_LANG']['tl_content']['vc_street_work']      = array('Street', 'Please enter the street name and number.');
$GLOBALS['TL_LANG']['tl_content']['vc_postal_work']      = array('Postal code', 'Please enter the postal code.');
$GLOBALS['TL_LANG']['tl_content']['vc_city_work']        = array('City', 'Plase enter the name of the city.');
$GLOBALS['TL_LANG']['tl_content']['vc_state_work']       = array('State', 'Plase enter the name of the state.');
$GLOBALS['TL_LANG']['tl_content']['vc_country_work']     = array('Country', 'Please select the country.');
$GLOBALS['TL_LANG']['tl_content']['vc_street_home']      = array('Street', 'Please enter the street name and number.');
$GLOBALS['TL_LANG']['tl_content']['vc_box_home']      = array('P.O. Box', 'Please enter the P.O. Box.');
$GLOBALS['TL_LANG']['tl_content']['vc_postal_home']      = array('Postal code', 'Please enter the postal code.');
$GLOBALS['TL_LANG']['tl_content']['vc_city_home']        = array('City', 'Plase enter the name of the city.');
$GLOBALS['TL_LANG']['tl_content']['vc_state_home']       = array('State', 'Plase enter the name of the state.');
$GLOBALS['TL_LANG']['tl_content']['vc_country_home']     = array('Country', 'Please select the country.');
$GLOBALS['TL_LANG']['tl_content']['vc_phone_work']       = array('Business phone', 'Please enter the phone number.');
$GLOBALS['TL_LANG']['tl_content']['vc_fax_work']       = array('Business fax', 'Please enter the fax number.');
$GLOBALS['TL_LANG']['tl_content']['vc_phone_mobile']      = array('Mobile phone', 'Please enter the mobile phone number.');
$GLOBALS['TL_LANG']['tl_content']['vc_phone_home']       = array('Home phone', 'Please enter the phone number.');
$GLOBALS['TL_LANG']['tl_content']['vc_mail1']       = array('E-mail address 1', 'Please enter a valid e-mail address.');
$GLOBALS['TL_LANG']['tl_content']['vc_mail2']       = array('E-mail address 2', 'Please enter a valid e-mail address.');
$GLOBALS['TL_LANG']['tl_content']['vc_mail3']       = array('E-mail address 3', 'Please enter a valid e-mail address.');
$GLOBALS['TL_LANG']['tl_content']['vc_web']     = array('Website', 'Here you can enter a web address.');
$GLOBALS['TL_LANG']['tl_content']['vc_encoding']     = array('vCard encoding', 'Define the encoding of the vCard. Default should be UTF-8 but some clients (Outlook) require Latin-1.');
$GLOBALS['TL_LANG']['tl_content']['vc_image']     = array('Photo', 'Select a photo for the vCard.');
$GLOBALS['TL_LANG']['tl_content']['encoding']['utf-8']     = 'UTF-8 (Unicode) encoding (recommended)';
$GLOBALS['TL_LANG']['tl_content']['encoding']['latin1']     = 'Latin-1 (Windows) encoding (Microsoft Outlook)';
$GLOBALS['TL_LANG']['tl_content']['encoding']['both']     = 'Both, UTF-8 and Latin-1 encoding';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['vcardtype_legend']      = 'VCard type';
$GLOBALS['TL_LANG']['tl_content']['personal_legend'] = 'Personal data';
$GLOBALS['TL_LANG']['tl_content']['address_work_legend']  = 'Business address';
$GLOBALS['TL_LANG']['tl_content']['address_home_legend']  = 'Home address';
$GLOBALS['TL_LANG']['tl_content']['communication_legend']  = 'Contact details';
$GLOBALS['TL_LANG']['tl_content']['image_legend']  = 'Photo';

?>