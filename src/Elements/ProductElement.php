<?php

namespace Medboubazine\Moogold\Elements;

use Medboubazine\Moogold\Abstracts\ElementsAbstract;
use Medboubazine\Moogold\Helpers\Collection;
use Medboubazine\Moogold\Interfaces\ElementsInterface;

class ProductElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        string $name,
        string $image_url,
        Collection $offers,
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setImageUrl($image_url);
        $this->setOffers($offers);
    }
}
