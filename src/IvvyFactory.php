<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

use Fcds\Ivvy\Ivvy;

final class IvvyFactory
{
    public function newInstance(string $apiKey, string $apiSecret, $region = null): Ivvy
    {
        $signature = new Signature;
        
        $baseUri = Ivvy::makeBaseUri($region);

        $client = new \GuzzleHttp\Client([
            'base_uri' => $baseUri,
            'timeout'  => 5.0,
        ]);

        return new Ivvy($apiKey, $apiSecret, $signature, $client);
    }
}
