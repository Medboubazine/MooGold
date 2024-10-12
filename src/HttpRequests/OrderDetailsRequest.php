<?php

namespace Medboubazine\Moogold\HttpRequests;

use Medboubazine\Moogold\Exceptions\InvalidServerResponse;
use Medboubazine\Moogold\Interfaces\HttpRequestInterface;
use Medboubazine\Moogold\Abstracts\HttpRequestAbstract;
use Medboubazine\Moogold\Interfaces\ElementsInterface;
use Medboubazine\Moogold\Elements\OrderElement;
use Medboubazine\Moogold\Helpers\Carbon;

class OrderDetailsRequest extends HttpRequestAbstract implements HttpRequestInterface
{
    /**
     * Path
     *
     * @var string
     */
    public string $path = "order/order_detail";
    /**
     * Handle request
     *
     * @return ElementsInterface|null
     */
    public function handle(int $id): ?OrderElement
    {
        $body = json_encode([
            "path" => $this->path,
            "order_id" => $id,
        ]);

        $response = $this->__guzzle_request("POST", $this->path, $this->buildHeaders($body), [
            "body" => $body
        ]);

        if ($response->getStatusCode() === 200) {
            $contents = $response->getBody();
            $contents_array = json_decode($contents, true);

            if ($contents_array and is_array($contents_array)) {

                if (isset($contents_array['order_id'])) {
                    //// Calc items
                    $offer_id = null;
                    $quantity = 0;
                    $total = 0;
                    $items = [];

                    foreach ($contents_array['item'] as $item) {
                        $offer_id = $item['variation_id'];
                        $quantity += $item['quantity'];
                        $total += $item['price'];
                        $delivered_keys = (is_array($item['voucher_code'])) ? $item['voucher_code'] : [];

                        $items = array_merge($items, $delivered_keys);
                    }
                    //DateTime
                    $datetime = $contents_array['date_created'];
                    $date = $datetime['date'];
                    $timezone = $datetime['timezone'];
                    ////
                    return new OrderElement(
                        $contents_array['order_id'],
                        $offer_id,
                        $contents_array['order_status'],
                        $quantity,
                        $total,
                        $items,
                        Carbon::parse($date, $timezone),
                    );
                }
            }
        }

        InvalidServerResponse::message($response);

        return null;
    }
}
