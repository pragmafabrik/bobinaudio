<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class PsuMap extends \Model\Bobinaudio\Transfo\TransformerMap
{
    public function initialize()
    {
        parent::initialize();

        $this->object_class =  'Model\Bobinaudio\Transfo\Psu';
        $this->object_name  =  'transfo.psu';

        $this->addField('power', 'int4');
        $this->addField('pri', 'transfo.winding');
        $this->addField('secs', 'transfo.winding[]');

        $this->pk_fields = array('transformer_id');
    }
}
