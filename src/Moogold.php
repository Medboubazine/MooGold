<?php

namespace Medboubazine\Moogold;

use Medboubazine\Moogold\Api\Orders;
use Medboubazine\Moogold\Api\Products;
use Medboubazine\Moogold\Api\User;
use Medboubazine\Moogold\Auth\Credentials;

class Moogold
{

    /**
     * Constructor
     */
    public function __construct(
        protected Credentials $credentials
    ) {}

    /**
     * User API Requests
     *
     * @return User
     */
    public function user(): User
    {
        return new User($this->credentials);
    }
    /**
     * Products API Requests
     *
     * @return Products
     */
    public function products(): Products
    {
        return new Products($this->credentials);
    }
    /**
     * Orders API Requests
     *
     * @return Orders
     */
    public function orders(): Orders
    {
        return new Orders($this->credentials);
    }
}
