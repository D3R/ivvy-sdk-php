<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$perPage = $argv[3];
$start = $argv[4];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$contacts = $ivvy->getContactListPage($perPage, $start);

if ($contacts) {
    echo implode("\n", array_map(function($contact) {
        return ($contact->firstName);
    }, $contacts));
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
