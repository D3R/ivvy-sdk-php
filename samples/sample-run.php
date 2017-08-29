<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$asyncId = $ivvy->run([
    new Fcds\Ivvy\PingJob,
    new Fcds\Ivvy\PingJob,
]);
if ($asyncId) {
    echo "Async ID: {$asyncId}\n";
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
}
