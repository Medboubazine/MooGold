<?php

namespace Medboubazine\Moogold\HttpRequests;

use Medboubazine\Moogold\Abstracts\HttpRequestAbstract;
use Medboubazine\Moogold\Elements\BalanceElement;
use Medboubazine\Moogold\Exceptions\InvalidServerResponse;
use Medboubazine\Moogold\Interfaces\HttpRequestInterface;

class BalanceRequest extends HttpRequestAbstract implements HttpRequestInterface
{
    /**
     * Path
     *
     * @var string
     */
    public string $path = "user/balance";
    /**
     * Handle request
     *
     * @return BalanceElement|null
     */
    public function handle(): ?BalanceElement
    {
        $body = json_encode([
            "path" => $this->path
        ]);

        $response = $this->__guzzle_request("POST", $this->path, $this->buildHeaders($body), [
            "body" => $body
        ]);

        if ($response->getStatusCode() === 200) {
            $contents = $response->getBody();
            $contents_array = json_decode($contents, true);

            if ($contents_array and is_array($contents_array)) {
                if (isset($contents_array['currency'])) {
                    return new BalanceElement($contents_array['balance'], $contents_array['currency']);
                }
            }
        }

        InvalidServerResponse::message($response);

        return null;
    }
}
