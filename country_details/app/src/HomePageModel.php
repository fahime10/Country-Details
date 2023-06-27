<?php

namespace Country;

class HomePageModel
{
    public function __construct(){}

    public function __destruct(){}

    public function getCountryNamesAndIsoCodes($soap_wrapper): array
    {
        $country_names = [];
        $country_details = [];

        $soap_client_handle = $soap_wrapper->createSoapClient();

        if ($soap_client_handle !== false)
        {
            $webservice_function = 'ListOfCountryNamesByCode';
            $webservice_call_parameters = [];
            $webservice_return_value = 'ListOfCountryNamesByCodeResult';
            $soapcall_result = $soap_wrapper->performSoapCall($soap_client_handle, $webservice_function, $webservice_call_parameters);

            $webservice_result = $soapcall_result->$webservice_return_value;
            $country_names = $webservice_result->tCountryCodeAndName;

            foreach ($country_names as $country_detail)
            {
                $country_details[$country_detail->sISOCode] = $country_detail->sName;
            }
        }
        return $country_details;
    }
}