<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];
$id = $argv[3];
$email = $argv[4];
$firstName = $argv[5];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$jobFactory = new Fcds\Ivvy\JobFactory(
    new Fcds\Ivvy\Model\Validator\AddCompanyValidator,
    new Fcds\Ivvy\Model\Validator\UpdateCompanyValidator,
    new Fcds\Ivvy\Model\Validator\AddContactValidator,
    new Fcds\Ivvy\Model\Validator\UpdateContactValidator
);

$contact = new Fcds\Ivvy\Model\Contact(compact('id', 'email', 'firstName'));

$asyncId = $ivvy->run([
    $jobFactory->newUpdateContactJob($contact),
]);

if ($asyncId) {
    echo "Async ID: {$asyncId}\n";
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
