<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$options = $ivvy->getOptions();

if ($options) {
    echo print_r($options, true);
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
