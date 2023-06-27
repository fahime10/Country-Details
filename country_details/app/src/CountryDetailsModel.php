<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 24/10/17
 * Time: 10:01
 */

namespace Country;

class CountryDetailsModel
{
    private $country_code;
    private $detail;
    private $result;
    private $xml_parser;

    public function __construct()
    {
        $this->xml_parser = null;
        $this->country_code = '';
        $this->detail = '';
        $this->result = [];
    }

    public function __destruct(){}

    public function setParameters($cleaned_parameters)
    {
        $this->country_code = $cleaned_parameters['country'];
        $this->detail = $cleaned_parameters['detail'];
    }

    public function getCountryDetails($soap_wrapper, array $cleaned_parameters, array $webservice_parameters)
    {
        $webservice_result = null;

        $soap_client_handle = $soap_wrapper->createSoapClient();

        if ($soap_client_handle !== false)
        {
            $webservice_function = $webservice_parameters['required_service'];
            $webservice_call_parameters = $webservice_parameters['service_parameters'];
            $webservice_return_object = $webservice_parameters['result_object'];

            $soapcall_result = $soap_wrapper->performSoapCall(
                $soap_client_handle,
                $webservice_function,
                $webservice_call_parameters
            );

            $webservice_result = $soapcall_result->$webservice_return_object;
        }
        return $webservice_result;
    }

    public function selectCountryDetails($required_country_details): array
    {
        $selected_details = [];
        $country_code = $required_country_details['country'];
        $required_country_detail = $required_country_details['detail'];

        switch($required_country_detail)
        {
            case 'capital':
                $selected_details['required_service'] = 'CapitalCity';
                $selected_details['service_parameters'] = [
                    'sCountryISOCode' => $country_code
                ];
                $selected_details['result_object'] = 'CapitalCityResult';
                break;
            case 'full':
                $selected_details['required_service'] = 'FullCountryInfo';
                $selected_details['service_parameters'] = [
                    'sCountryISOCode' => $country_code
                ];
                $selected_details['result_object'] = 'FullCountryInfoResult';
                break;
            case 'currency':
                $selected_details['required_service'] = 'CountryCurrency';
                $selected_details['service_parameters'] = [
                    'sCountryISOCode' => $country_code
                ];
                $selected_details['result_object'] = 'CountryCurrencyResult';
            default:
        }
        return $selected_details;
    }

    public function cleanupUserOptions($validator, $tainted_parameters): array
    {
        $cleaned_parameters = [];
        $validated_country_code = false;
        $validated_detail_option = false;

        if (isset($tainted_parameters['country']))
        {
            $tainted_country = $tainted_parameters['country'];
            $validated_country_code = $validator->validateCountryCode($tainted_country);
        }

        if (isset($tainted_parameters['detail']))
        {
            $tainted_detail = $tainted_parameters['detail'];
            $validated_detail_option = $validator->validateDetailType($tainted_detail);
        }

        if ($validated_country_code && $validated_detail_option)
        {
            $cleaned_parameters['country'] = $validated_country_code;
            $cleaned_parameters['detail'] = $validated_detail_option;
        }

        return $cleaned_parameters;
    }

    public function validateCountryDetails($validator, $tainted_data)
    {
        $cleaned_data = '';

        if (is_string($tainted_data))
        {
            $cleaned_data = $validator->validateDownloadedData($tainted_data);
        }
        else
        {
            $cleaned_data = $tainted_data;
        }

        return $cleaned_data;
    }

//    public function getCountryDetails($soap_wrapper, $cleaned_parameters)
//    {
//        $country_detail_result = [];
//
//
//        $countrydetails_model->performDetailRetrieval();
//        $country_detail_result = $countrydetails_model->getResult();
//
//        return $country_detail_result;
//    }
}