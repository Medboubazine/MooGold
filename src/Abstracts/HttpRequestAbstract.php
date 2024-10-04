<?php

namespace Medboubazine\Moogold\Abstracts;

use GuzzleHttp\Client;
use Medboubazine\Moogold\Auth\Credentials;
use Psr\Http\Message\ResponseInterface;

abstract class HttpRequestAbstract
{
    /**
     * Constructor
     *
     * @param [type] $credentials
     */
    public function __construct(public Credentials $credentials) {}
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
     * @param string $timestamp
     * @param string $signature
     * @param string $auth_basic
     * @return array
     */
    public function buildHeaders(string $timestamp, string $signature, string $auth_basic): array
    {
        return [
            'timestamp' => $timestamp,
            'auth' => $signature,
            'Authorization' => "Basic {$auth_basic}",
        ];
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function calculateAuthorizationCredentials(): string
    {
        return base64_encode("{$this->credentials->partner_id}:{$this->credentials->secret_key}");
    }
    /**
     * Calc signature
     *
     * @return string
     */
    public function calculateSignature(string $body, int $timestamp, string $path): string
    {
        return hash_hmac('SHA256', "{$body}{$timestamp}{$path}", $this->credentials->secret_key);
    }
}
