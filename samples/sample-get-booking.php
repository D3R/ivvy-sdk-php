<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$id = $argv[3];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$booking = $ivvy->getBooking($id);

if ($booking) {
    echo "{$booking->code}\n";
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
