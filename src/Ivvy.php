<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

use GuzzleHttp\Client;

/**
 * Class: Ivvy
 *
 * @final
 */
final class Ivvy
{
    /**
     * @var Signature
     */
    private $signature;

    private function __construct(
        string $apiKey,
        string $apiSecret,
        Signature $signature,
        Client $client
    ) {
        $this->apiKey    = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->signature = $signature;
        $this->client    = $client;
    }

    /**
     * Returns an instance of Ivvy.
     *
     * @param string $apiKey
     * @param string $apiSecret
     *
     * @return Ivvy
     */
    public static function getInstance(string $apiKey, string $apiSecret, $signature = null, $client = null)
    {
        // NOTE: this approach is incorrect. Probably use a factory pattern intead.
        if (!$signature) {
            $signature = new Signature;
        }
        if (!$client) {
            $client = new \GuzzleHttp\Client([
                'base_uri' => $baseUri,
                'timeout'  => 5.0,
            ]);
        }

        return new static($apiKey, $apiSecret, $signature, $client);
    }

    /**
     * NOTE: using the following design, the query params are part of the request URI
     * as they're not really parameters anymore but always-required values.
     * Pings the iVvy API service.
     *
     * @return bool - whether the connection was successful.
     */
    public function ping(): bool
    {
        $host = 'api.us-west-2.ivvy.com';
        $apiVersion = '1.0';

        $baseUri = "https://{$host}";
        $requestUri = "/api/{$apiVersion}/test?action=ping";

        $contentType = 'application/json';
        $body = json_encode(['example' => 'body']);
        $contentMd5 = md5($body);
        $ivvyDate = date('Y-m-d hh:mm:ss');


        $signature = $this->signature->sign(
            $this->apiSecret,
            $contentMd5,
            $requestUri,
            ['IVVY-Date' => $ivvyDate]
        );

        $response = $this->client->request('POST', $requestUri, [
            'body' => $body,
            'headers' => [
                'Content-Type' => $contentType,
                'Content-MD5' => $contentMd5,
                'IVVY-Date' => $ivvyDate,
                'X-Api-Version' => $apiVersion,
                'X-Api-Authorization' => "IWS {$this->apiKey}:{$signature}",
            ],
        ]);

        return $response->getStatusCode() === 200;
    }
}
