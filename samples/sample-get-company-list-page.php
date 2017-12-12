<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$perPage = $argv[3];
$start = $argv[4];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$companies = $ivvy->getCompanyListPage($perPage, $start);

echo var_dump($companies);

if ($companies) {
    echo implode("\n", array_map(function($company) {
        return $company->businessName;
    }, $companies));
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
