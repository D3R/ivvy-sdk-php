<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$id = $argv[3];
$businessName = $argv[4];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$jobFactory = new Fcds\Ivvy\JobFactory(
    new Fcds\Ivvy\Model\Validator\AddCompanyValidator,
    new Fcds\Ivvy\Model\Validator\UpdateCompanyValidator,
    new Fcds\Ivvy\Model\Validator\AddContactValidator,
    new Fcds\Ivvy\Model\Validator\UpdateContactValidator
);

// NOTE: there's a bug where you can't make it work unless AU and QLD
$address = new Fcds\Ivvy\Model\Address([
    'stateCode' => 'QLD',
    'countryCode' => 'AU',
    'postalCode' => '4227',
]);
$company = new Fcds\Ivvy\Model\Company(compact('id', 'businessName', 'address'));

$asyncId = $ivvy->run([
    $jobFactory->newUpdateCompanyJob($company),
]);

if ($asyncId) {
    echo "Async ID: {$asyncId}\n";
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
