<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class TransformerPsuMap extends \Model\Bobinaudio\Transfo\TransformerMap
{
    public function initialize()
    {
        parent::initialize();

        $this->object_class =  'Model\Bobinaudio\Transfo\TransformerPsu';
        $this->object_name  =  '"transfo"."transformer_psu"';

        $this->addField('power', 'int4');
        $this->addField('pri', 'transfo.winding');
        $this->addField('secs', 'transfo.winding[]');

        $this->pk_fields = array('transformer_id');
    }
}
