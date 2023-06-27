<?php

namespace Country;

class HomePageController
{
    public function __construct(){}

    public function __destruct(){}

    public function createHomePage($app, $response)
    {
        $homepage_model = $app->getContainer()->get('homePageModel');
        $homepage_view = $app->getContainer()->get('homePageView');
        $soap_wrapper = $app->getContainer()->get('soapWrapper');
        $view = $app->getContainer()->get('view');

        $country_names = $homepage_model->getCountryNamesAndIsoCodes($soap_wrapper);

        $homepage_view->createHomePageView($view, $response, $country_names);
    }
}