<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication GUID
    |--------------------------------------------------------------------------
    |
    | To access ABN Lookup web services, an authentication GUID (Globally
    |  Unique Identifier) is required. You can find your own GUID from the
    |  email received after your registration is completed.
    |
    | For more details, visit below link;
    |  https://abr.business.gov.au/Tools/WebServices#registration
    |
    */

    'auth_guid' => env('ABNLOOKUP_AUTH_GUID'),

    /*
    |--------------------------------------------------------------------------
    | WSDL path
    |--------------------------------------------------------------------------
    |
    | Path to WSDL which describes the web services of ABN Lookup. It is
    |  recommended not to change this value from default.
    |
    | For more details, visit below link;
    |  https://abr.business.gov.au/Tools/WebServices#wsdl
    |
    */

    'wsdl' => \SparkEleven\AbnLookup\Services\AbnLookupService::DEFAULT_WSDL,

    /*
    |--------------------------------------------------------------------------
    | WSDL cache method
    |--------------------------------------------------------------------------
    |
    | For better performance, it is recommended to cache the WSDL file. Do not
    |  change this value if you are not sure about it, or you will experience
    |  terrible response time.
    |
    | Must be one of;
    |  * WSDL_CACHE_NONE
    |  * WSDL_CACHE_DISK
    |  * WSDL_CACHE_MEMORY
    |  * WSDL_CACHE_BOTH
    |
    | For more details, visit below link;
    |  https://www.php.net/manual/en/soapclient.soapclient.php
    |
    */

    'wsdl_cache' => env('ABNLOOKUP_WSDL_CACHE', WSDL_CACHE_DISK),

];
