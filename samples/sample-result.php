<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$asyncId = $argv[3];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$result = $ivvy->result($asyncId);

if ($result['results']) {
    foreach ($result['results'] as $jobResult) {
        $jobResultRequest = array_map(function($value) { return is_array($value) ? implode(', ', $value) : $value; },  $jobResult['request']);
        $jobDescription = implode(', ', $jobResultRequest);
        $responseDescription = implode(', ', $jobResult['response']);

        echo "{$jobResult['namespace']}/{$jobResult['action']}: {$jobDescription}\n";
        echo "Response: {$responseDescription}\n";
        echo "\n";
    }
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
