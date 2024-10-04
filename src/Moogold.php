<?php

namespace Medboubazine\Moogold;

use Medboubazine\Moogold\Auth\Credentials;
use Medboubazine\Moogold\HttpRequests\BalanceRequest;
use Medboubazine\Moogold\HttpRequests\ProductDetailsRequest;
use Medboubazine\Moogold\HttpRequests\ProductsListRequest;
use Medboubazine\Moogold\HttpRequests\ProductsRequest;

class Moogold
{

    /**
     * Constructor
     */
    public function __construct(
        protected Credentials $credentials
    ) {}

    /**
     * Balance
     *
     * @return BalanceRequest
     */
    public function balance(): BalanceRequest
    {
        return new BalanceRequest($this->credentials);
    }
    /**
     * Products
     *
     * @return ProductsRequest
     */
    public function products_list(): ProductsListRequest
    {
        return new ProductsListRequest($this->credentials);
    }
    /**
     * Details
     *
     * @return ProductDetailsRequest
     */
    public function product_details(): ProductDetailsRequest
    {
        return new ProductDetailsRequest($this->credentials);
    }
}
