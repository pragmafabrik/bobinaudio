<?php

namespace Model\Type\Transfo;

use \Pomm\Type\Composite;

class Winding extends Composite
{
    public $current;
    public $voltage;
    public $impedance;

    public function __toString()
    {
        $current = ($this->current >= 1000) ?  sprintf("%02.1fA", $this->current / 1000) : sprintf("%dmA", $this->current);
        $voltage = ($this->voltage % 10 == 0) ? sprintf("%dV", $this->voltage / 10) : sprintf("%02.1fV", $this->voltage / 10);
        if (!is_null($this->impedance))
        {
            $impedance = ($this->impedance >= 10) ? sprintf("%dΩ", $this->impedance / 10) : sprintf("%02.1fΩ", $this->impedance / 10);
        }

        return sprintf("%s / %s%s", $voltage, $current, isset($impedance) ? sprintf(" / %s", $impedance) : '');
    }
}

