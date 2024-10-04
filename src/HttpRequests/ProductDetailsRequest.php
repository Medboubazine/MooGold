<?php

namespace Medboubazine\Moogold\HttpRequests;

use Medboubazine\Moogold\Exceptions\InvalidServerResponse;
use Medboubazine\Moogold\Interfaces\HttpRequestInterface;
use Medboubazine\Moogold\Abstracts\HttpRequestAbstract;
use Medboubazine\Moogold\Elements\ProductElement;
use Medboubazine\Moogold\Elements\ProductOfferElement;
use Medboubazine\Moogold\Interfaces\ElementsInterface;
use Medboubazine\Moogold\Helpers\Collection;

class ProductDetailsRequest extends HttpRequestAbstract implements HttpRequestInterface
{
    /**
     * Path
     *
     * @var string
     */
    public string $path = "product/product_detail";
    /**
     * Handle request
     *
     * @return ElementsInterface|null
     */
    public function details(int $product_id): ?Collection
    {
        $body = json_encode([
            "path" => $this->path,
            "product_id" => $product_id,
        ]);

        $response = $this->__guzzle_request("POST", $this->path, $this->buildHeaders($body), [
            "body" => $body
        ]);

        if ($response->getStatusCode() === 200) {
            $contents = $response->getBody();
            $contents_array = json_decode($contents, true);

            if ($contents_array and is_array($contents_array)) {

                if (isset($contents_array['Product_Name'])) {
                    $collection = new Collection([]);
                    //Offers
                    $offers = new Collection();

                    foreach ($contents_array['Variation'] as $offer) {
                        $offers->push(new ProductOfferElement($offer['variation_id'], $offer['variation_name'], $offer['variation_price']));
                    }
                    //END OFFERS
                    $collection->push(new ProductElement(
                        $product_id,
                        $contents_array['Product_Name'],
                        $contents_array['Image_URL'],
                        $offers,
                    ));

                    return $collection;
                }
            }
        }

        InvalidServerResponse::message($response);

        return null;
    }
}
