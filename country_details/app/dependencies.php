<?php

// Register component on container
$container['view'] = function ($container) {
  $view = new \Slim\Views\Twig(
    $container['settings']['view']['template_path'],
    $container['settings']['view']['twig'],
    [
      'debug' => true // This line should enable debug mode
    ]
  );

  // Instantiate and add Slim specific extension
  $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
  $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

  return $view;
};

$container['homePageController'] = function ($container) {
  $validator = new \Country\HomePageController();
  return $validator;
};

$container['homePageModel'] = function () {
  $validator = new \Country\HomePageModel();
  return $validator;
};

$container['homePageView'] = function () {
  $validator = new \Country\HomePageView();
  return $validator;
};

$container['countryDetailsController'] = function () {
  $model = new \Country\CountryDetailsController();
  return $model;
};

$container['countryDetailsModel'] = function () {
  $model = new \Country\CountryDetailsModel();
  return $model;
};

$container['countryDetailsView'] = function () {
  $model = new \Country\CountryDetailsView();
  return $model;
};

$container['validator'] = function () {
    $validator = new \Country\Validator();
    return $validator;
};

$container['soapWrapper'] = function () {
    $validator = new \Country\SoapWrapper();
    return $validator;
};

$container['databaseWrapper'] = function() {
    $database_handle = new \Country\DatabaseWrapper();
    return $database_handle;
};
