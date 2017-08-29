<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$jobFactory = new Fcds\Ivvy\JobFactory;

$asyncId = $ivvy->run([
    $jobFactory->newPingJob(),
    $jobFactory->newPingJob(),
]);

if ($asyncId) {
    echo "Async ID: {$asyncId}\n";
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
}
