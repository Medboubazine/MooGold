<?php

namespace Medboubazine\Moogold\Api;

use Medboubazine\Moogold\Abstracts\ApiAbstract;
use Medboubazine\Moogold\Elements\OrderElement;
use Medboubazine\Moogold\HttpRequests\OrderCreationRequest;
use Medboubazine\Moogold\HttpRequests\OrderDetailsRequest;

class Orders extends ApiAbstract
{
    /**
     * Create order
     *
     * @return OrderElement|null
     */
    public function create(int $type, string $external_id, string $offer_id, int $quantity): ?OrderElement
    {
        $request = new OrderCreationRequest($this->credentials);

        return $request->handle($type, $external_id, $offer_id, $quantity);
    }
    /**
     * Get order details
     *
     * @param integer $id
     * @return OrderElement|null
     */
    public function details(int $id): ?OrderElement
    {
        $request = new OrderDetailsRequest($this->credentials);

        return $request->handle($id);
    }
}
