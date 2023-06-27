<?php
/**
 * Created by PhpStorm.
 * User: cfi
 * Date: 20/11/15
 * Time: 14:01
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post(
    '/processcountrydetails',
    function (Request $request, Response $response) use ($app) {

        $tainted_parameters = $request->getParsedBody();

        $country_details_model = $app->getContainer()->get('countryDetailsController');
        $country_details_model->createResults($app, $response, $tainted_parameters);

    }
);
