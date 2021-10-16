<?php


namespace App\Services;


use SparkEleven\AbnLookup\Facades\AbnLookup;

class AbnChecker
{
    public $abn;

    function __construct($abn)
    {
        $this->abn = $abn;
    }

    public function isValidBusiness() : bool
    {
        try {
            $result = AbnLookup::searchByAbn($this->abn);

            $status = $result['entityStatus']['entityStatusCode'];

            if ( !$status || strtolower($status) !== 'active') {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
