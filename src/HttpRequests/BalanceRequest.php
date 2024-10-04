<?php

namespace Medboubazine\Moogold\HttpRequests;

use Medboubazine\Moogold\Abstracts\HttpRequestAbstract;
use Medboubazine\Moogold\Elements\BalanceElement;
use Medboubazine\Moogold\Interfaces\ElementsInterface;
use Medboubazine\Moogold\Interfaces\HttpRequestInterface;

class BalanceRequest extends HttpRequestAbstract implements HttpRequestInterface
{
    /**
     * Handle request
     *
     * @return ElementsInterface|null
     */
    public function handle(array $args = []): ?ElementsInterface
    {
        //
        // Request URI
        //
        $path = "user/balance";
        //
        // Request timestamp
        //
        $timestamp = time();
        ///
        /// BODY
        ///
        $body = json_encode([
            "path" => $path
        ]);

        $response = $this->__guzzle_request(
            "POST",
            $path,
            $this->buildHeaders(
                $timestamp,
                $this->calculateSignature($body, $timestamp, $path),
                $this->calculateAuthorizationCredentials(),
            ),
            [
                "body" => $body
            ]
        );
        if ($response->getStatusCode() === 200) {
            $contents = $response->getBody()->getContents();
            $contents_array = json_decode($contents, true);

            if ($contents_array and is_array($contents_array)) {
                if (isset($contents_array['currency'])) {
                    return new BalanceElement($contents_array['balance'], $contents_array['currency']);
                }
            }
        }
        return null;
    }
}
