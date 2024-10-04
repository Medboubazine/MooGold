<?php

namespace Medboubazine\Moogold\Elements;

use Medboubazine\Moogold\Abstracts\ElementsAbstract;
use Medboubazine\Moogold\Interfaces\ElementsInterface;

class CategoryElement extends ElementsAbstract implements ElementsInterface
{
    public function __construct(
        string $id,
        string $name
    ) {
        $this->setId($id);
        $this->setName($name);
    }
}
