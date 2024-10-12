<?php

namespace Medboubazine\Moogold\Api;

use Medboubazine\Moogold\Abstracts\ApiAbstract;
use Medboubazine\Moogold\Helpers\Collection;
use Medboubazine\Moogold\HttpRequests\ProductDetailsRequest;
use Medboubazine\Moogold\HttpRequests\ProductsListRequest;

class Products extends ApiAbstract
{

    /**
     * Get products categories list
     *
     * @param integer $category_id
     * @return Collection|null
     */
    public function list(int $category_id): ?Collection
    {
        $request = new ProductsListRequest($this->credentials);

        return $request->handle($category_id);
    }
    /**
     * Get product details
     *
     * @param integer $product_id
     * @return Collection|null
     */
    public function details(int $product_id): ?Collection
    {
        $request = new ProductDetailsRequest($this->credentials);

        return $request->handle($product_id);
    }
}
