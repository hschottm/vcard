<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Table tl_content
 */

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'vcard_type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['vcard'] = '{type_legend},type,headline;{vcardtype_legend},vcard_type';
$GLOBALS['TL_DCA']['tl_content']['palettes']['vcardvhttp'] = '{type_legend},type,headline;{vcardtype_legend},vcard_type,vcard_http;{link_legend},linkTitle,vc_encoding;{protected_legend:hide},protected;{expert_legend},{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['vcardvmember'] = '{type_legend},type,headline;{vcardtype_legend},vcard_type,vcard_member;{link_legend},linkTitle,vc_encoding;{protected_legend:hide},protected;{expert_legend},{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['palettes']['vcardvcustom'] = '{type_legend},type,headline;{vcardtype_legend},vcard_type;{personal_legend},vc_title,vc_firstname,vc_lastname,vc_birthday,vc_company,vc_jobtitle,vc_department;{communication_legend},vc_mail1,vc_mail2,vc_mail3,vc_web,vc_phone_work,vc_fax_work,vc_phone_mobile,vc_phone_home;{address_work_legend},vc_box_work,vc_street_work,vc_city_work,vc_state_work,vc_postal_work,vc_country_work;{address_home_legend},vc_box_home,vc_street_home,vc_city_home,vc_state_home,vc_postal_home,vc_country_home;{link_legend},linkTitle,vc_encoding;{protected_legend:hide},protected;{expert_legend},{expert_legend:hide},guests,cssID,space';


$GLOBALS['TL_DCA']['tl_content']['fields']['vcard_type'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vcard_type'],
	'default'                 => 'vmember',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('vmember','vhttp','vcustom'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_content']['vcard_type'],
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vcard_member'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vcard_member'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'options_callback'        => array('tl_content_vcard','getAvailableMembers'),
	'eval'                    => array('mandatory'=>true),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vcard_http'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vcard_http'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true),
	'sql'                     => "varchar(50) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_firstname'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_firstname'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_lastname'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_lastname'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_birthday'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_birthday'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard'),
	'sql'                     => "varchar(11) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_title'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_title'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
	'sql'                     => "varchar(128) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_company'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_company'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_jobtitle'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_jobtitle'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
	'sql'                     => "varchar(128) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_department'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_department'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
	'sql'                     => "varchar(128) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_mail1'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_mail1'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'email', 'decodeEntities'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_mail2'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_mail2'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'email', 'decodeEntities'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_mail3'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_mail3'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'email', 'decodeEntities'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_web'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_web'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'url', 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_box_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_box_work'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>32, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_phone_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_phone_work'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'phone', 'decodeEntities'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_fax_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_fax_work'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'phone', 'decodeEntities'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_phone_mobile'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_phone_mobile'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'phone', 'decodeEntities'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_phone_home'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_phone_home'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'rgxp'=>'phone', 'decodeEntities'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_street_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_street_work'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_city_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_city_work'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_state_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_state_work'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_postal_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_postal_work'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>32, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_country_work'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_country_work'],
	'exclude'                 => true,
	'filter'                  => true,
	'sorting'                 => true,
	'inputType'               => 'select',
	'options'                 => $this->getCountries(),
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(2) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_box_home'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_box_home'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>32, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_street_home'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_street_home'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_city_home'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_city_home'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_state_home'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_state_home'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_postal_home'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_postal_home'],
	'exclude'                 => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false, 'maxlength'=>32, 'tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_country_home'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_country_home'],
	'exclude'                 => true,
	'filter'                  => true,
	'sorting'                 => true,
	'inputType'               => 'select',
	'options'                 => $this->getCountries(),
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(2) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['vc_encoding'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['vc_encoding'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'options_callback'        => array('tl_content_vcard','getEncodings'),
	'eval'                    => array('mandatory'=>true, 'tl_class' => 'clr'),
	'sql'                     => "int(10) unsigned NOT NULL default '1'"
);

/**
 * Class tl_content_vcard
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Helmut Schottmüller 2009
 * @author     Helmut Schottmüller <typolight@aurealis.de>
 * @package    Controller
 */
class tl_content_vcard extends Backend
{
	public function getAvailableMembers()
	{
		$objMember = $this->Database->prepare("SELECT id, firstname, lastname FROM tl_member WHERE disable <> '1' ORDER BY lastname, firstname")
			->execute();
		$members = array();
		while ($objMember->next())
		{
			$members[$objMember->id] = trim($objMember->firstname . " " . $objMember->lastname);
		}
		return $members;
	}
	
	public function getEncodings()
	{
		return array(
			1 => $GLOBALS['TL_LANG']['tl_content']['encoding']['utf-8'],
			2 => $GLOBALS['TL_LANG']['tl_content']['encoding']['latin1'],
			4 => $GLOBALS['TL_LANG']['tl_content']['encoding']['both']
		);
	}
}

?>