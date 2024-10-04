<?php

namespace Medboubazine\Moogold\Elements;

use Medboubazine\Moogold\Abstracts\ElementsAbstract;
use Medboubazine\Moogold\Interfaces\ElementsInterface;

class ProductOfferElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        string $name,
        string $price
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setPrice($price);
    }
}
