<?php

namespace Country;

class CountryDetailsView
{
    private $country_name;
    private $capital_city;
    private $language;
    private $currency;
    private $flag_url;

    public function __construct() {
        $this->country_name = null;
        $this->capital_city = null;
        $this->language = null;
        $this->currency = null;
        $this->flag_url = null;
    }

    public function __destruct(){}

    public function createResultsView($view, $response, $results)
    {
        if (!is_string($results) && isset($results->sCapitalCity)) {

            $this->country_name = $results->sName;

            $this->capital_city = $results->sCapitalCity;

            if($results->Languages->tLanguage->sName != null) {
                $this->language = $results->Languages->tLanguage->sName;
            } else {
                $this->language = '';
            }

            if ($results->sCurrencyISOCode != null) {
                $this->currency = $results->sCurrencyISOCode;
            } else {
                $this->currency = '';
            }

            if ($results->sCountryFlag != null) {
                $this->flag_url = $results->sCountryFlag;
            } else {
                $this->flag_url = '';
            }

            $view->render(
                $response,
                'display_result.html.twig',
                [
                    'css_path' => CSS_PATH,
                    'landing_page' => LANDING_PAGE,
                    'page_title' => APP_NAME,
                    'page_heading_1' => APP_NAME,
                    'page_heading_2' => 'Result',
                    'country_name' => $this->country_name,
                    'capital_city' => $this->capital_city,
                    'language' => $this->language,
                    'currency' => $this->currency,
                    'detail' => '',
                    'flag' => $this->flag_url,
                ]);
        } else if (is_string($results)) {

            $this->capital_city = $results;

            $view->render(
                $response,
                'capital.html.twig',
                [
                    'css_path' => CSS_PATH,
                    'landing_page' => LANDING_PAGE,
                    'page_title' => APP_NAME,
                    'page_heading_1' => APP_NAME,
                    'page_heading_2' => 'Result',
                    'country_name' => $this->country_name,
                    'capital_city' => $this->capital_city,
                ]);
        } else {
            $this->currency = $results->sName;

            $view->render(
                $response,
                'currency.html.twig',
                [
                    'css_path' => CSS_PATH,
                    'landing_page' => LANDING_PAGE,
                    'page_title' => APP_NAME,
                    'page_heading_1' => APP_NAME,
                    'page_heading_2' => 'Result',
                    'currency' => $this->currency,
                ]);
        }
    }

    public function createResultsViewCurrency($view, $response, $results)
    {

    }
}