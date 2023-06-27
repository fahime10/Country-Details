<?php
/**
 * homepage.php
 *
 * display the check primes application homepage
 *
 * allows the user to enter a value for testing if prime
 *
 * Author: CF Ingrams
 * Email: <cfi@dmu.ac.uk>
 * Date: 18/10/2015
 *
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function(Request $request, Response $response) use ($app)
{
    $homepage_controller = $app->getContainer()->get('homePageController');

    $homepage_controller->createHomePage($app, $response);

});
