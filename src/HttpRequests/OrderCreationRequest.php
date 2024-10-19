<?php

namespace Medboubazine\Moogold\HttpRequests;

use Medboubazine\Moogold\Exceptions\InvalidServerResponse;
use Medboubazine\Moogold\Interfaces\HttpRequestInterface;
use Medboubazine\Moogold\Abstracts\HttpRequestAbstract;
use Medboubazine\Moogold\Interfaces\ElementsInterface;
use Medboubazine\Moogold\Elements\OrderElement;

class OrderCreationRequest extends HttpRequestAbstract implements HttpRequestInterface
{
    /**
     * Type of Delivery
     */
    const TYPE_DIRECT_TOPUP = 1;
    /**
     * Type of Delivery
     */
    const TYPE_E_VOUCHERS = 2;
    /**
     * Path
     *
     * @var string
     */
    public string $path = "order/create_order";
    /**
     * Handle request
     *
     * @return ElementsInterface|null
     */
    public function handle(int $type, string $external_id, string $offer_id, int $quantity): ?OrderElement
    {
        $body = json_encode([
            "path" => $this->path,
            "data" => [
                "category" => $type,
                "product-id" => $offer_id,
                "quantity" => $quantity,
            ],
            "partnerOrderId" => $external_id,
        ]);

        $response = $this->__guzzle_request("POST", $this->path, $this->buildHeaders($body), [
            "body" => $body
        ]);

        if ($response->getStatusCode() === 200) {
            $contents = $response->getBody();
            $contents_array = json_decode($contents, true);

            if ($contents_array and is_array($contents_array)) {

                if (isset($contents_array['status']) and isset($contents_array['order_id'])) {
                    return new OrderElement(
                        $contents_array['order_id'],
                    );
                }
            }
        }

        InvalidServerResponse::message($response);

        return null;
    }
}
