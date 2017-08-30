<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$asyncId = $argv[3];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$result = $ivvy->result($asyncId);

echo print_r($result, true);

if ($result['results']) {
    echo "Wait for it\n";
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
