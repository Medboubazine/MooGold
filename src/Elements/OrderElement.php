<?php

namespace Medboubazine\Moogold\Elements;

use Medboubazine\Moogold\Abstracts\ElementsAbstract;
use Medboubazine\Moogold\Helpers\Carbon;
use Medboubazine\Moogold\Interfaces\ElementsInterface;

class OrderElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        ?string $offer_id = null,
        ?string $status = null,
        ?int $quantity = 0,
        ?string $total = null,
        ?array $items = null,
        ?Carbon $created_at = null,
    ) {
        $this->setId($id);
        $this->setOfferId($offer_id);
        $this->setStatus($status);
        $this->setQuantity($quantity);
        $this->setTotal($total);
        $this->setItems($items);
        $this->setCreatedAt($created_at);
    }
}
