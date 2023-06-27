<?php

require 'vendor/autoload.php';

$settings = require __DIR__ . '/app/settings.php';

$container = new \Slim\Container($settings);

require __DIR__ . '/app/dependencies.php';

$app = new \Slim\App($container);

require __DIR__ . '/app/routes.php';

try {
    $app->run();
} catch (Exception $e) {
    // display an error message
    die(json_encode(array("status" => "failed", "message" => "Did you say the magic word???")));
}
