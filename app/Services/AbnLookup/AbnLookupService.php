<?php

namespace App\Services\AbnLookup;


/**
 * ABN Lookup service.
 *
 * @author Theodore Yaosin <theo@sparkeleven.com.au>
 */
class AbnLookupService
{

    protected static $client;

    /**
     * Authentication GUID.
     *
     * @var string
     */
    protected static $auth_guid;

    /**
     * WSDL path.
     *
     * @var string
     */
    protected static $wsdl;

    /**
     * WSDL cache method.
     *
     * @var int
     */
    protected static $wsdl_cache;

    /**
     * Default WSDL path for ABR Search API.
     *
     * @var string
     */
    const DEFAULT_WSDL = 'https://abr.business.gov.au/abrxmlsearch/ABRXMLSearch.asmx?WSDL';

    /**
     * Enum values of state abbreviations.
     *
     * @var array
     */
    const STATES = [
        'NSW',
        'SA',
        'ACT',
        'VIC',
        'WA',
        'NT',
        'QLD',
        'TAS',
    ];

    /**
     * Reset service.
     *
     * @param  string  $auth_guid
     * @param  string  $wsdl
     * @param  int  $wsdl_cache
     */
    public static function reset(string $auth_guid = null, string $wsdl = null, int $wsdl_cache = null)
    {
        static::$auth_guid = $auth_guid;
        static::$wsdl = $wsdl;
        static::$wsdl_cache = $wsdl_cache;

        static::$client = null;
    }

    /**
     * Get authentication GUID.
     *
     * @return string
     */
    public static function getAuthGuid()
    {
        return static::$auth_guid;
    }

    /**
     * Get WSDL path.
     *
     * @return string
     */
    public static function getWsdl()
    {
        return static::$wsdl;
    }

    /**
     * Get WSDL cache method.
     *
     * @return int
     */
    public static function getWsdlCache()
    {
        return static::$wsdl_cache;
    }

    /**
     * Returns SOAP client instance.
     *
     * @return \SoapClient
     *
     * @throws \SparkEleven\AbnLookup\Exceptions\NoAuthGuidException
     * @throws \SoapFault
     */
    protected static function client(): \SoapClient
    {

        if (! static::$auth_guid) {
            throw new \Exception('config for guid abn lookup empty');
        }

        if (! isset(static::$client) || ! (static::$client instanceof \SoapClient)) {
            static::$client = new \SoapClient(static::$wsdl, [
                'soap_version' => SOAP_1_1,
                'exceptions' => true,
                'trace' => 1,
                'cache_wsdl' => static::$wsdl_cache
            ]);
        }

        return static::$client;
    }

    /**
     * Parse payload of response and return arrayed result.
     *
     * @param  \stdClass  $response
     * @param  string  $child
     * @return array
     *
     * @throws \Exception
     */
    protected static function parseResponsePayload(\stdClass $response, string $child = null): array
    {
        if (isset($response->exception)) {
            throw new \Exception($response->exception);
        }

        if ($child) {
            return fromObjectToArray($response->{$child});
        } else {
            return fromObjectToArray($response);
        }
    }

    /**
     * Search by ABN.
     *  Using SearchByABNv202001.
     *
     * @param  string  $abn
     * @param  bool  $historical
     * @return array
     *
     * @link https://abr.business.gov.au/Documentation/WebServiceMethods#abn
     */
    public static function searchByAbn(string $abn, bool $historical = false): array
    {
        $params = new \stdClass();

        $params->searchString = $abn;
        $params->includeHistoricalDetails = ynbool($historical);
        $params->authenticationGuid = static::$auth_guid;

        return static::parseResponsePayload(
            static::client()->SearchByABNv202001($params)
                ->ABRPayloadSearchResults
                ->response,
            'businessEntity202001'
        );
    }

    /**
     * Search by ASIC (ACN or ARBN).
     *  Using SearchByASICv201408.
     *
     * @param  string  $acn
     * @param  bool  $historical
     * @return array
     *
     * @link https://abr.business.gov.au/Documentation/WebServiceMethods#acn
     */
    public static function searchByAsic(string $acn, bool $historical = false): array
    {
        $params = new \stdClass();

        $params->searchString = $acn;
        $params->includeHistoricalDetails = ynbool($historical);
        $params->authenticationGuid = static::$auth_guid;

        return static::parseResponsePayload(
            static::client()->SearchByASICv201408($params)
                ->ABRPayloadSearchResults
                ->response,
            'businessEntity201408'
        );
    }

    /**
     * Search by name.
     *  Using ABRSearchByName.
     *
     * @param  string  $name
     * @param  string  $postcode
     * @param  bool  $isLegalName
     * @param  bool  $isTradingName
     * @param  array  $states
     * @return array
     *
     * @link https://abr.business.gov.au/Documentation/WebServiceMethods#name
     */
    public static function searchByName(
        string $name,
        string $postcode = null,
        bool $isLegalName = null,
        bool $isTradingName = null,
        array $states = []
    ): array {
        $params = new \stdClass();
        $params->externalNameSearch = new \stdClass();

        $params->externalNameSearch->name = $name;
        $params->externalNameSearch->filters = new \stdClass();
        $params->externalNameSearch->filters->nameType = new \stdClass();
        $params->externalNameSearch->filters->stateCode = new \stdClass();
        $params->externalNameSearch->filters->postcode = $postcode;

        if (null !== $isLegalName) {
            $params->externalNameSearch->filters->nameType->legalName = ynbool($isLegalName);
        }

        if (null !== $isTradingName) {
            $params->externalNameSearch->filters->nameType->tradingName = ynbool($isTradingName);
        }

        foreach (array_keys($states) as $state) {
            if (in_array($state, self::STATES)) {
                $params->externalNameSearch->filters->stateCode->{$state} = ynbool($states[$state]);
            }
        }

        $params->authenticationGuid = static::$auth_guid;

        return static::parseResponsePayload(
            static::client()->ABRSearchByName($params)
                ->ABRPayloadSearchResults
                ->response,
            'searchResultsList'
        );
    }
}
