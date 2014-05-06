<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class TransformerOptSeMap extends \Model\Bobinaudio\Transfo\TransformerMap
{
    public function initialize()
    {
        parent::initialize();

        $this->object_class =  'Model\Bobinaudio\Transfo\TransformerOptSe';
        $this->object_name  =  '"transfo"."transformer_opt_se"';

        $this->addField('pri_ldc', 'numeric');
        $this->addField('power', 'int4');
        $this->addField('z_pri', 'int4');
        $this->addField('z_secs', 'int4[]');
        $this->addField('flo', 'int4');
        $this->addField('fhi', 'int4');

        $this->pk_fields = array('transformer_id');
    }
}
