<?php

namespace Country;

class CountryDetailsController
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function createResults($app, $response, $tainted_parameters)
    {
        $country_details_model = $app->getContainer()->get('countryDetailsModel');
        $country_details_view = $app->getContainer()->get('countryDetailsView');
        $soap_wrapper = $app->getContainer()->get('soapWrapper');
        $validator = $app->getContainer()->get('validator');
        $view = $app->getContainer()->get('view');

        $cleaned_required_country_details = $country_details_model->cleanupUserOptions($validator, $tainted_parameters);
        $webservice_parameters = $country_details_model->selectCountryDetails($cleaned_required_country_details);

        $country_details_result = $country_details_model->getCountryDetails(
            $soap_wrapper,
            $cleaned_required_country_details,
            $webservice_parameters
        );

        $validated_country_details = $country_details_model->validateCountryDetails(
            $validator,
            $country_details_result
        );

        $country_details_view->createResultsView($view, $response, $validated_country_details);
    }
}
