<?php

namespace Model\Type\Transfo;

use \Pomm\Type\Composite;

class Winding extends Composite
{
    public $current;
    public $voltage;
    public $impedance;

    public function getTolerance()
    {
        $current = ($this->current >= 1000) ?  sprintf("%02.1fA", $this->current / 1000) : sprintf("%dmA", $this->current);

        if (count($this->voltage) > 1)
        {
            $voltage = sprintf("(%s)", join('|', array_map(function($val) { return ($val % 10 == 0) ? sprintf("%dV", $val / 10) : sprintf("%02.1fV", $val / 10); }, $this->voltage)));
        }
        else
        {
            $voltage = ($this->voltage[0] % 10 == 0) ? sprintf("%dV", $this->voltage[0] / 10) : sprintf("%02.1fV", $this->voltage[0] / 10);
        }

        return sprintf("%s / %s", $voltage, $current);
    }

    public function getImpedance()
    {
        if (!is_null($this->impedance))
        {
            return ($this->impedance >= 100) ? sprintf("%dΩ", $this->impedance / 10) : sprintf("%1.01fΩ", $this->impedance / 10);
        }
    }

    public function __toString()
    {
        $impedance = $this->getImpedance();

        return sprintf("%s%s", $this->getTolerance(), !is_null($impedance) ? sprintf(" / %s", $impedance) : '');
    }
}

