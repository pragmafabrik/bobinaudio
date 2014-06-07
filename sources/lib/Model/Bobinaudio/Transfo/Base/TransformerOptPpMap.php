<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class TransformerOptPpMap extends \Model\Bobinaudio\Transfo\TransformerMap
{
    public function initialize()
    {
        parent::initialize();

        $this->object_class =  'Model\Bobinaudio\Transfo\TransformerOptPp';
        $this->object_name  =  '"transfo"."transformer_opt_pp"';

        $this->addField('pri_ldc', 'numeric');
        $this->addField('power', 'int4');
        $this->addField('z_pri', 'int4');
        $this->addField('z_secs', 'int4[]');
        $this->addField('flo', 'int4');
        $this->addField('fhi', 'int4');
        $this->addField('ul', 'numeric');

        $this->pk_fields = array('transformer_id');
    }
}