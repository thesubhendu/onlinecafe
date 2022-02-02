<?php


namespace App\Services;


use SparkEleven\AbnLookup\Facades\AbnLookup;

class AbnChecker
{
    public $abn;
    public $abnResponse;

    function __construct($abn)
    {
        $this->abn = $abn;
        $this->initAbnResponse();
    }

    public function initAbnResponse()
    {
        try {
            $this->abnResponse = AbnLookup::searchByAbn($this->abn);
        } catch (\Exception $e) {
            logger()->error('Error searching abn name - '. $e->getMessage());
            $this->abnResponse = null;
        }
    }

    public function isValidBusiness() : bool
    {
        try {
            $status = $this->abnResponse['entityStatus']['entityStatusCode'];

            if ( !$status || strtolower($status) !== 'active') {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function isValidBusinessName($businessName) : bool
    {
        try {
            $actualBusinessName = $this->abnResponse['businessName']['organisationName'];

            if(strtolower(trim($actualBusinessName)) != strtolower(trim($businessName))) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
