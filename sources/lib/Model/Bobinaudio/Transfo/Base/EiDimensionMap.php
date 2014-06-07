<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class EiDimensionMap extends BaseObjectMap
{
    public function initialize()
    {

        $this->object_class =  'Model\Bobinaudio\Transfo\EiDimension';
        $this->object_name  =  'transfo.ei_dimension';

        $this->addField('ei_dimension_id', 'int4');
        $this->addField('ref', 'varchar');
        $this->addField('len_a', 'int4');
        $this->addField('len_b', 'int4');
        $this->addField('len_c', 'int4');
        $this->addField('diameter', 'numeric');
        $this->addField('average_h', 'int4');

        $this->pk_fields = array('ei_dimension_id');
    }
}
