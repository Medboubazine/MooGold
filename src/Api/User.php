<?php

namespace Medboubazine\Moogold\Api;

use Medboubazine\Moogold\Abstracts\ApiAbstract;
use Medboubazine\Moogold\Elements\BalanceElement;
use Medboubazine\Moogold\HttpRequests\BalanceRequest;

class User extends ApiAbstract
{
    /**
     * Get balance
     *
     * @return BalanceElement|null
     */
    public function balance(): ?BalanceElement
    {
        $request = new BalanceRequest($this->credentials);

        return $request->handle();
    }
}
