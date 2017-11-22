<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$date = $argv[3] ?? null;

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$invoices = $ivvy->getInvoiceListFromDate($date);

if ($invoices) {
    echo implode("\n", array_map(function($invoice) {
        return $invoice->reference;
    }, $invoices));
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
