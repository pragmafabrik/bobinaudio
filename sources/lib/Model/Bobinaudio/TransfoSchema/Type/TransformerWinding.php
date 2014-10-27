<?php

namespace Model\Bobinaudio\TransfoSchema\Type;

use PommProject\ModelManager\Model\FlexibleEntity;

/**
 * TransformerWinding
 *
 * Flexible entity for a winding type.
 *
 * @package Bobinaudio
 * @copyright 2014 Grégoire HUBERT
 * @author Grégoire HUBERT
 * @license X11 {@link http://opensource.org/licenses/mit-license.php}
 * @see FlexibleEntity
 */
class TransformerWinding extends FlexibleEntity
{
    /**
     * getTolerance
     *
     * Format tolerance.
     *
     * @access public
     * @return string
     */
    public function getTolerance()
    {
        $current = ($this->get('current') >= 1000) ?  sprintf("%02.1fA", $this->get('current') / 1000) : sprintf("%dmA", $this->get('current'));

        if (count($this->get('voltage')) > 1) {
            $voltage = sprintf(
                "(%s)",
                join(
                    '|',
                    array_map(function($val) { return ($val % 10 == 0) ? sprintf("%dV", $val / 10) : sprintf("%02.1fV", $val / 10); }, $this->get('voltage'))
            )
        );
        } else {
            $voltage = ($this->get('voltage')[0] % 10 == 0) ? sprintf("%dV", $this->get('voltage')[0] / 10) : sprintf("%02.1fV", $this->get('voltage')[0] / 10);
        }

        return sprintf("%s / %s", $voltage, $current);
    }

    /**
     * getImpedance
     *
     * Format impedance.
     *
     * @access public
     * @return string
     */
    public function getImpedance()
    {
        if ($this->has('impedance' && $this->get('impedance') !== null)) {
            return ($this->get('impedance') >= 100) ? sprintf("%dΩ", $this->get('impedance') / 10) : sprintf("%1.01fΩ", $this->get('impedance') / 10);
        }
    }

    /**
     * __toString
     *
     * String representation.
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s%s", $this->getTolerance(), $this->has('impedance') && $this->get('impedance') !== null ? sprintf(" / %s", $this->getImpedance()) : '');
    }
}
