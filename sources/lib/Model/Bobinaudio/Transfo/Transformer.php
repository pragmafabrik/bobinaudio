<?php

namespace Model\Bobinaudio\Transfo;

use \Pomm\Object\BaseObject;
use \Pomm\Exception\Exception;

class Transformer extends BaseObject
{
    const DIMENSION_EI66 = 1;
    const DIMENSION_EI78 = 2;
    const DIMENSION_EI84 = 3;
    const DIMENSION_EI96 = 4;
    const DIMENSION_EI108 = 5;
    const DIMENSION_EI126 = 6;
    const DIMENSION_EI150 = 7;

    public function getWeight()
    {
        return sprintf("%.1f", $this->get('weight'));
    }
}
