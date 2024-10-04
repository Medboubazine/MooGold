<?php

namespace Medboubazine\Moogold\HttpRequests;

use Medboubazine\Moogold\Exceptions\InvalidServerResponse;
use Medboubazine\Moogold\Interfaces\HttpRequestInterface;
use Medboubazine\Moogold\Abstracts\HttpRequestAbstract;
use Medboubazine\Moogold\Elements\CategoryElement;
use Medboubazine\Moogold\Elements\ProductListItemElement;
use Medboubazine\Moogold\Interfaces\ElementsInterface;
use Medboubazine\Moogold\Helpers\Collection;

class ProductsListRequest extends HttpRequestAbstract implements HttpRequestInterface
{
    /**
     * Path
     *
     * @var string
     */
    public string $path = "product/list_product";
    /**
     * Handle request
     *
     * @return ElementsInterface|null
     */
    public function list(int $category_id): ?Collection
    {
        $body = json_encode([
            "path" => $this->path,
            "category_id" => $category_id,
        ]);

        $response = $this->__guzzle_request("POST", $this->path, $this->buildHeaders($body), [
            "body" => $body
        ]);

        if ($response->getStatusCode() === 200) {
            $contents = $response->getBody();
            $contents_array = json_decode($contents, true);

            if ($contents_array and is_array($contents_array)) {
                $collection = new Collection([]);

                foreach ($contents_array as $item) {
                    if (isset($item['ID'])) {
                        $collection->push(new CategoryElement($item['ID'], $item['post_title']));
                    }
                }

                return $collection;
            }
        }

        InvalidServerResponse::message($response);

        return null;
    }
}
