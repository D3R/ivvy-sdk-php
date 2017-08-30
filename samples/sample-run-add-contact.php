<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$apiKey = $argv[1];
$apiSecret = $argv[2];

$ivvy = (new Fcds\Ivvy\IvvyFactory)->newInstance($apiKey, $apiSecret);

$jobFactory = new Fcds\Ivvy\JobFactory(
    new Fcds\Ivvy\Model\Validator\AddCompanyValidator,
    new Fcds\Ivvy\Model\Validator\UpdateCompanyValidator,
    new Fcds\Ivvy\Model\Validator\AddContactValidator,
    new Fcds\Ivvy\Model\Validator\UpdateContactValidator
);

$john = new Fcds\Ivvy\Model\Contact([
    'firstName' => 'John',
    'lastName' => 'Doe',
    'email'   => 'johndoe@mail.com',
    'phone' => '6789-1234',
]);

$mary = new Fcds\Ivvy\Model\Contact([
    'firstName' => 'Mary',
    'lastName' => 'Sue',
    'email'   => 'marysue@mail.com',
    'phone' => '+507 234-5678',
]);

$asyncId = $ivvy->run([
    $jobFactory->newAddContactJob($john),
    $jobFactory->newAddContactJob($mary),
]);

if ($asyncId) {
    echo "Async ID: {$asyncId}\n";
} else {
    echo "Couldn't connect to the API server. Check iVvy's credentials\n";
    exit(1);
}
