<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class SelfMap extends \Model\Bobinaudio\Transfo\TransformerMap
{
    public function initialize()
    {
        parent::initialize();

        $this->object_class =  'Model\Bobinaudio\Transfo\Self';
        $this->object_name  =  'transfo.self';

        $this->addField('pri', 'transfo.winding');
        $this->addField('inductance', 'numeric');

        $this->pk_fields = array('transformer_id');
    }
}
