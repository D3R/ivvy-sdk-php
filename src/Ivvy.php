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
    const HOST = 'api.us-west-2.ivvy.com';
    const API_VERSION = '1.0';
    const BASE_URI = "https://" . self::HOST;

    /** @var Signature */
    private $signature;

    /** @var Clint */
    private $client;

    /**
     * Creates a new instance
     *
     * @param string $apiKey
     * @param string $apiSecret
     * @param Signature $signature
     * @param Client $client
     */
    public function __construct(
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
     * Pings the iVvy API service.
     *
     * @return bool - whether the connection was successful.
     */
    public function ping(): bool
    {
        $requestUri = $this->createRequestUri('test', 'ping');

        $body = json_encode([]);

        $headers = $this->createHeaders($body, $requestUri);

        $response = $this->client->request('POST', $requestUri, compact('body', 'headers'));

        return $response->getStatusCode() === 200;
    }

    /**
     * Run the passed jobs
     *
     * @param array $jobs
     * @return string - the async Id
     */
    public function run(array $jobs): ?string
    {
        $requestUri = $this->createRequestUri('batch', 'run');
        $body = json_encode([
            'jobs' => array_map(
                function ($job) {
                    return $job->toArray();
                },
                $jobs
            ),
            'callbackUrl' => 'https://google.com',                  // TODO: remove this geeglo thing LEL
        ]);

        $headers = $this->createHeaders($body, $requestUri);

        $response = $this->client->request('POST', $requestUri, compact('body', 'headers'));

        if ($response->getStatusCode() === 200) {
            $json = json_decode((string) $response->getBody());

            return $json->asyncId;
        } else {
            return null;
        }
    }

    /**
     * Creates a request URI string from the passed namespace and action
     *
     * @param string $namespace
     * @param string $action
     *
     * @return string
     */
    protected function createRequestUri(string $namespace, string $action): string
    {
        $apiVersion = self::API_VERSION; // It just looks cooler this way

        return "/api/{$apiVersion}/{$namespace}?action={$action}";
    }

    /**
     * Creates the request headers
     *
     * @param string $body
     * @param string $requestUri
     *
     * @return array
     */
    protected function createHeaders(string $body, string $requestUri): array
    {
        $contentType = 'application/json';
        $contentMd5 = md5($body);
        $ivvyDate = $this->createIvvyDate();

        $signature = $this->signature->sign(
            $this->apiSecret,
            $contentMd5,
            $requestUri,
            ['IVVY-Date' => $ivvyDate]
        );

        return [
            'Content-Type' => $contentType,
            'Content-MD5' => $contentMd5,
            'IVVY-Date' => $ivvyDate,
            'X-Api-Version' => self::API_VERSION,
            'X-Api-Authorization' => "IWS {$this->apiKey}:{$signature}",
        ];
    }

    /**
     * Creates a date with the format specified by iVvy.
     *
     * @return string
     */
    protected function createIvvyDate(): string
    {
        return date('Y-m-d hh:mm:ss');
    }
}
