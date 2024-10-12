<?php

namespace Medboubazine\Moogold\Abstracts;

use GuzzleHttp\Client;
use Medboubazine\Moogold\Auth\Credentials;
use Psr\Http\Message\ResponseInterface;

abstract class HttpRequestAbstract
{
    /**
     * Request path
     *
     * @var string
     */
    public string $path;

    /**
     * Time
     *
     * @var integer
     */
    public int $timestamp;

    /**
     * Credentials
     *
     * @var Credentials
     */
    protected Credentials $credentials;
    /**
     * Constructor
     *
     * @param [type] $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
        $this->timestamp = time();
    }
    /**
     * __request
     *
     * @return ResponseInterface
     */
    public function __guzzle_request($method, $uri, $headers, $options = []): ResponseInterface
    {

        $client = new Client([
            "base_uri" => "https://moogold.com/wp-json/v1/api/",
            'timeout'  => 10,
            "allow_redirects" => false,
            "http_errors" => false,
            "verify" => true,
            "headers" => [
                "Accept" => "application/json",
                ...$headers,
            ],
        ]);

        return $client->request($method, $uri, $options);
    }
    /**
     * Build Headers
     *
     * @param string $body
     * @return array
     */
    public function buildHeaders(string $body): array
    {
        return [
            'timestamp' => $this->timestamp,
            'auth' => $this->calculateSignature($body),
            'Authorization' => "Basic " . base64_encode("{$this->credentials->partner_id}:{$this->credentials->secret_key}"),
        ];
    }
    /**
     * Calc signature
     *
     * @param string $body
     * @return string
     */
    protected function calculateSignature(string $body): string
    {
        return hash_hmac('SHA256', "{$body}{$this->timestamp}{$this->path}", $this->credentials->secret_key);
    }
}
