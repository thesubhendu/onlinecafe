<?php


namespace App\Services;


use App\Services\AbnLookup\AbnLookupService ;

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
            //init abn lookup service
            AbnLookupService::reset(
                config('abn-lookup.auth_guid'),
                config('abn-lookup.wsdl'),
                config('abn-lookup.wsdl_cache'),
            );
            $this->abnResponse = AbnLookupService::searchByAbn($this->abn);
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
    public function isValidBusinessName($enteredName) : bool
    {
        try {
            $organisationName = $this->abnResponse['businessName']['organisationName'] ?? null;

            if ($organisationName && $this->isMatching($organisationName, $enteredName)) {
                return true;
            }

            $mainName = $this->abnResponse['mainName']['organisationName'] ?? null;

            if ($mainName && $this->isMatching($mainName, $enteredName)) {
                return true;
            }

            $legalName = $this->abnResponse['legalName'] ?? null;

            if ($legalName) {
                $firstName = $legalName['givenName'];
                $middleName = $legalName['otherGivenName'];
                $lastName = $legalName['familyName'];
                $soleBusinessName = $firstName;
                if ($middleName) {
                    $soleBusinessName .= ' ' . $middleName;
                }
                $soleBusinessName .= ' ' . $lastName;

                if ($this->isMatching($soleBusinessName, $enteredName)) {
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }


    protected function isMatching(string $actualName, string $enteredName): bool
    {
        if(strtolower(trim($actualName)) == strtolower(trim($enteredName))) {
            return true;
        }

        return false;
    }
}
