<?php

namespace Model\Type\Transfo;

use \Pomm\Type\Composite;

class Winding extends Composite
{
    public $current;
    public $voltage;

    public function __toString()
    {
        return sprintf("%02.1fV / %02.3fA", $this->voltage / 10, $this->current / 1000);
    }
}

