<?php

namespace Medboubazine\Moogold;

use Medboubazine\Moogold\Auth\Credentials;
use Medboubazine\Moogold\Elements\BalanceElement;
use Medboubazine\Moogold\HttpRequests\BalanceRequest;

class Moogold
{

    /**
     * Constructor
     */
    public function __construct(
        protected Credentials $credentials
    ) {}

    /**
     * Get balance
     *
     * @return BalanceElement|null
     */
    public function balance(): ?BalanceElement
    {

        return (new BalanceRequest($this->credentials))->handle();
    }
}
