<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class TransformerMap extends BaseObjectMap
{
    public function initialize()
    {

        $this->object_class =  'Model\Bobinaudio\Transfo\Transformer';
        $this->object_name  =  '"transfo"."transformer"';

        $this->addField('transformer_id', 'uuid');
        $this->addField('ref', 'varchar');
        $this->addField('ei_dimension_id', 'int4');
        $this->addField('weight', 'numeric');
        $this->addField('height', 'int4');
        $this->addField('meta', 'json');

        $this->pk_fields = array('');
    }
}
