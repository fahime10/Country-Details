<?php

namespace Country;

class SoapWrapper
{

    public function __construct(){}
    public function __destruct(){}

    public function createSoapClient()
    {
        $soap_client_handle = false;
        $soap_client_parameters = [];
        $exception = '';

        $soap_client_parameters = ['trace' => true, 'exceptions' => true];

        try
        {
            $soap_client_handle = new \SoapClient(WSDL, $soap_client_parameters);
//            var_dump($soap_client_handle->__getFunctions());
//            var_dump($soap_client_handle->__getTypes());
        }
        catch (\SoapFault $exception)
        {
            $soap_client_handle = 'Ooops - something went wrong when connecting to the data supplier.  Please try again later';
        }
        return $soap_client_handle;
    }

    public function performSoapCall($soap_client_handle, $webservice_function, $webservice_call_parameters)
    {
        $soap_call_result = null;

        try {
            $soap_call_result = $soap_client_handle->__soapCall($webservice_function, [$webservice_call_parameters]);
//            var_dump($soap_client_handle->__getLastRequestHeaders());
//            var_dump($soap_client_handle->__getLastRequest());
//            var_dump($soap_client_handle->__getLastResponseHeaders());
//            var_dump($soap_client_handle->__getLastResponse());
        } catch (\SoapFault $exception) {
            trigger_error($exception);
        }

        return $soap_call_result;

    }
}