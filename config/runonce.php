<?php

class UpdateVCardRunonceJob extends Controller 
{ 
    public function __construct() 
    { 
        parent::__construct(); 
        $this->import('Database'); 
    } 
    public function run() 
    { 
        //Check for update to C3.2 
        if ($this->Database->tableExists('tl_content')) 
        { 
            $arrFields = $this->Database->listFields('tl_content'); 
            $blnDone = false; 
             
            //check for one table and field 
            foreach ($arrFields as $arrField) 
            { 
                if ($arrField['name'] == 'vc_image' && $arrField['type'] != 'varchar') 
                { 
	                Database\Updater::convertSingleField('tl_content', 'vc_image'); 
                } 
            } 
             
        } 
         
    } 
} 

$objUpdateVCardRunonceJob = new UpdateVCardRunonceJob(); 
$objUpdateVCardRunonceJob->run();

