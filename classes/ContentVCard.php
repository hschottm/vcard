<?php

namespace Contao;

/**
 * Class ContentVCard
 *
 * Front end content element "vcard".
 * @copyright  Helmut Schottmüller 2009-2012
 * @author     Helmut Schottmüller <https://github.com/hschottm>
 * @package    Controller
 */
class ContentVCard extends \ContentElement
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_vcard';
	protected $arrMember = array();
	protected $strTitle = "";

	/**
	 * Return if the file does not exist
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### VCARD ###';
			return $objTemplate->parse();
		}

		$this->strTitle = $this->linkTitle;

		if (strlen($this->Input->get('type')) && strlen($this->Input->get('vcard')))
		{
			$this->vcard_type = $this->Input->get('type');
			$this->vcard_member = $this->Input->get('vcard');
		}

		switch ($this->vcard_type)
		{
			case "vmember":
				if (strlen($this->vcard_member))
				{
					$objMember = $this->Database->prepare("SELECT * FROM tl_member WHERE id = ?")
						->execute($this->vcard_member);
					if ($objMember->numRows)
					{
						$this->arrMember = $objMember->row();
						$this->arrMember['type'] = 'vmember';
					}
				}
				if (count($this->arrMember) == 0) return '';
				break;
			case "vhttp":
				$id = strlen($this->Input->get($this->vcard_http)) ? $this->Input->get($this->vcard_http) : $this->Input->post($this->vcard_http);
				if (strlen($id))
				{
					$objMember = $this->Database->prepare("SELECT * FROM tl_member WHERE id = ?")
						->execute($id);
					if ($objMember->numRows)
					{
						$this->arrMember = $objMember->row();
						$this->arrMember['type'] = 'vhttp';
					}
				}
				if (count($this->arrMember) == 0) return '';
				break;
			case "vcustom":
				break;
		}
		// Send vcard to the browser
		if (strlen($this->Input->get('vcard')) && strcmp($this->vcard_type, 'vcustom') == 0 && $this->Input->get('vcard') == $this->id)
		{
			if (isset($GLOBALS['TL_HOOKS']['customvcard']) && is_array($GLOBALS['TL_HOOKS']['customvcard']))
			{
				foreach ($GLOBALS['TL_HOOKS']['customvcard'] as $callback)
				{
					$this->import($callback[0]);
					$vcard = $this->$callback[0]->$callback[1]($vcard, $this);
				}
			}
			else
			{
				$vcard = $this->getCustomVCard();
			}
			$content = $vcard->parse();
			$this->sendContent($content, $vcard->getMimetype(), $this->getFullname());
		}
		else if (strlen($this->Input->get('type')) && strlen($this->Input->get('vcard')))
		{
			// HOOK: custom creation of vcard
			if (isset($GLOBALS['TL_HOOKS']['customvcard']) && is_array($GLOBALS['TL_HOOKS']['customvcard']))
			{
				foreach ($GLOBALS['TL_HOOKS']['customvcard'] as $callback)
				{
					$this->import($callback[0]);
					$vcard = $this->$callback[0]->$callback[1]($vcard, $this->arrMember);
				}
			}
			else
			{
				$vcard = $this->getVCard($this->arrMember);
			}
			$content = $vcard->parse();
			$this->sendContent($content, $vcard->getMimetype(), $this->getFullname());
		}

		return parent::generate();
	}
	
	protected function sendContent($content, $mimetype, $filename)
	{
		$encoding = (strcmp($this->Input->get('encoding'), 'latin1') == 0) ? 'ISO-8859-1' : 'UTF-8';
		if (strcmp($encoding, 'ISO-8859-1') == 0) 
		{
			$content = utf8_decode($content);
			$content_length = strlen($content);
		}
		else
		{
			$content_length = mb_strlen($content);
		}
		header('Content-Type: ' . $mimetype . ";charset=" . $encoding);
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: attachment; filename="'. $filename .'.vcf"');
		header('Content-Length: '.$content_length);
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
		header('Pragma: public');
		header('Expires: 0');
		echo $content;
		exit;
	}
	
	protected function getVCard(&$arrMember)
	{
		$vcard = new \vcard();
		$this->loadLanguageFile('countries');
		$publicfields = $this->getPublicFields();
		$firstname = (in_array('firstname', $publicfields)) ? $arrMember['firstname'] : "";
		$lastname = (in_array('lastname', $publicfields)) ? $arrMember['lastname'] : "";
		$vcard->setName($lastname, $firstname);
		$vcard->setFormattedName($this->getFullname());
		if (strlen($arrMember['avatar'])) 
		{
			$f = \FilesModel::findOneById($arrMember['avatar']);
			if ($f)
			{
				$file = new \File($f->path);
				$vcard->setPhoto($file->getContent(), 'image/' . $f->extension);
			}
		}
		if (in_array('dateOfBirth', $publicfields) && strlen($arrMember['dateOfBirth']))
		{
			$day = (int)date("d", $arrMember['dateOfBirth']);
			$month = (int)date("m", $arrMember['dateOfBirth']);
			$year = (int)date("Y", $arrMember['dateOfBirth']);
			$vcard->setBirthday($year, $month, $day);
		}
		$street = (in_array('street', $publicfields)) ? $arrMember['street'] : "";
		$city = (in_array('city', $publicfields)) ? $arrMember['city'] : "";
		$postal = (in_array('postal', $publicfields)) ? $arrMember['postal'] : "";
		$country = (in_array('country', $publicfields)) ? $GLOBALS['TL_LANG']['CNT'][$arrMember['country']] : "";
		$vcard->setAddress("", "", $street, $city, "", $postal, $country, ADR_TYPE_POSTAL);
		$phone = (in_array('phone', $publicfields)) ? $arrMember['phone'] : "";
		if (strlen($phone)) $vcard->setPhone($phone, $GLOBALS['TL_CONFIG']['vcard']['phonetype']);
		$fax = (in_array('fax', $publicfields)) ? $arrMember['fax'] : "";
		if (strlen($fax)) $vcard->setPhone($fax, TEL_TYPE_FAX);
		$mobile = (in_array('mobile', $publicfields)) ? $arrMember['mobile'] : "";
		if (strlen($mobile)) $vcard->setPhone($mobile, TEL_TYPE_CELL);
		$email = (in_array('email', $publicfields)) ? $arrMember['email'] : "";
		if (strlen($email)) $vcard->setEmail($email);
		$company = (in_array('company', $publicfields)) ? $arrMember['company'] : "";
		if (strlen($company)) $vcard->setOrganization($company);
		$url = (in_array('website', $publicfields)) ? $arrMember['website'] : "";
		if (strlen($url)) $vcard->setURL($url);
		$vcard->setProductId("Contao");
		return $vcard;
	}

	protected function getCustomVCard()
	{
		$vcard = new \vcard();
		$this->loadLanguageFile('countries');
		$firstname = $this->vc_firstname;
		$lastname = $this->vc_lastname;
		$vcard->setName($lastname, $firstname, "", $this->vc_title);
		$vcard->setFormattedName($this->getFullname());
		if (strlen($this->vc_birthday))
		{
			$day = (int)date("d", $this->vc_birthday);
			$month = (int)date("m", $this->vc_birthday);
			$year = (int)date("Y", $this->vc_birthday);
			$vcard->setBirthday($year, $month, $day);
		}
		$vcard->setTitle($this->vc_jobtitle);
		$vcard->setOrganization($this->vc_company);
		if (strlen($this->vc_mail1)) $vcard->setEmail($this->vc_mail1);
		if (strlen($this->vc_mail2)) $vcard->setEmail($this->vc_mail2);
		if (strlen($this->vc_mail3)) $vcard->setEmail($this->vc_mail3);
		if (strlen($this->vc_web)) $vcard->setURL($this->vc_web);
		if (strlen($this->vc_image)) 
		{
			$f = \FilesModel::findOneById($this->vc_image);
			if ($f)
			{
				$file = new \File($f->path);
				$vcard->setPhoto($file->getContent(), 'image/' . $f->extension);
			}
		}
		if (strlen($this->vc_phone_home)) $vcard->setPhone($this->vc_phone_home, TEL_TYPE_HOME);
		if (strlen($this->vc_phone_work)) $vcard->setPhone($this->vc_phone_work, TEL_TYPE_WORK);
		if (strlen($this->vc_fax_work)) $vcard->setPhone($this->vc_fax_work, TEL_TYPE_FAX);
		if (strlen($this->vc_phone_mobile)) $vcard->setPhone($this->vc_phone_mobile, TEL_TYPE_CELL);
		$this->loadLanguageFile('countries');
		if (strlen($this->vc_box_work . $this->vc_street_work . $this->vc_city_work . $this->vc_state_work . $this->vc_postal_work . $this->vc_country_work)) $vcard->setAddress($this->vc_box_work, "", $this->vc_street_work, $this->vc_city_work, $this->vc_state_work, $this->vc_postal_work, $GLOBALS['TL_LANG']['CNT'][$this->vc_country_work], ADR_TYPE_WORK);
		if (strlen($this->vc_box_home . $this->vc_street_home . $this->vc_city_home . $this->vc_state_home . $this->vc_postal_home . $this->vc_country_home)) $vcard->setAddress($this->vc_box_home, "", $this->vc_street_home, $this->vc_city_home, $this->vc_state_home, $this->vc_postal_home, $GLOBALS['TL_LANG']['CNT'][$this->vc_country_home], ADR_TYPE_DOM);
		$vcard->setProductId("Contao");
		return $vcard;
	}
	
	protected function getPublicFields()
	{
		$publicFields = deserialize($this->arrMember['publicFields'], true);
		foreach ($publicFields as $key => $field)
		{
			if (!array_key_exists($field, $this->arrMember)) unset($publicFields[$key]);
		}
		return $publicFields;
	}
	
	protected function getFullname()
	{
		if (strcmp($this->vcard_type, 'vcustom') == 0)
		{
			return trim($this->vc_title . ' ' . $this->vc_firstname . ' ' . $this->vc_lastname);
		}
		else
		{
			return trim($this->arrMember['firstname'] . ' ' . $this->arrMember['lastname']);
		}
	}


	/**
	 * Generate content element
	 */
	protected function compile()
	{
		$this->loadLanguageFile('tl_content');
		$link = (!strlen($this->strTitle)) ? $this->getFullname() : $this->strTitle;
		$src = $this->Environment->request;
		$this->Template->link = specialchars($link);
		$encoding = ($this->vc_encoding == 2) ? 'latin1' : 'utf8';
		$this->Template->encoding = $encoding;
		if (strcmp($this->vcard_type, 'vcustom') == 0)
		{
			$this->Template->href = $this->addToUrl("vcard=" . $this->id . "&amp;encoding=" . $encoding);
		}
		else
		{
			$this->Template->href = $this->addToUrl("vcard=" . $this->arrMember['id'] . "&amp;type=" . $this->arrMember['type'] . "&amp;encoding=" . $encoding);
		}
		if ($this->vc_encoding == 4)
		{
			$encoding = 'latin1';
			$this->Template->encoding2 = $encoding;
			if (strcmp($this->vcard_type, 'vcustom') == 0)
			{
				$this->Template->href2 = $this->addToUrl("vcard=" . $this->id . "&amp;encoding=" . $encoding);
			}
			else
			{
				$this->Template->href2 = $this->addToUrl("vcard=" . $this->arrMember['id'] . "&amp;type=" . $this->arrMember['type'] . "&amp;encoding=" . $encoding);
			}
		}
		$this->Template->title = specialchars($GLOBALS['TL_LANG']['tl_content']['vcard_title']);
	}
}

?>