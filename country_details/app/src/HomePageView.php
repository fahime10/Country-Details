<?php

namespace Country;

class HomePageView
{
    public function __construct(){}

    public function __destruct(){}

    public function createHomePageView($view, $response, $country_names)
    {
        $view->render(
            $response,
            'homepageform.html.twig',
            [
                'css_path' => CSS_PATH,
                'landing_page' => LANDING_PAGE,
                'method' => 'post',
                'action' => 'processcountrydetails',
//                'initial_input_box_value' => null,
                'page_title' => APP_NAME,
                'page_heading_1' => APP_NAME,
                'page_heading_2' => 'Display details about a country',
                'country_names' => $country_names,
                'page_text' => 'Select a country name, then select the required information details',
            ]
        );
    }
}
