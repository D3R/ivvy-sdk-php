<?php
namespace Fcds\Ivvy;

/**
 * Class: Signature
 * 
 * Signs the IWS string based on the parameters
 */
class Signature
{
    public function sign(
        string $apiSecret, 
        string $contentMd5, 
        string $requestUri, 
        array $ivvyHeaders = [],
        string $date = '',
        string $method = 'POST',
        string $contentType = 'application/json',
        string $apiVersion = '1.0'
    ): string
    {
        $parsedHeaders = $this->parseHeaders($ivvyHeaders);

        $stringToSign = implode(
            '',
            [
                $method,
                $contentMd5,
                $contentType,
                $date,
                $requestUri,
                $apiVersion,
                implode('&', $parsedHeaders)
            ]
        );

        $stringToSign = strtolower($stringToSign);

        return hash_hmac("sha1", $stringToSign, $apiSecret);
    }

    /**
     * Parse an array of headers and values to the format needed for the signature
     *
     * @param array $ivvyHeaders
     */
    public function parseHeaders(array $ivvyHeaders): array
    {
        $parsedHeaders = [];

        foreach ($ivvyHeaders as $header => $value) {
            $header = str_replace('-', '', $header);

            $parsedHeaders[] = "{$header}={$value}";
        }

        return $parsedHeaders;
    }
}
