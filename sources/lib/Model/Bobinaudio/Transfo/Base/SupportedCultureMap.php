<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class SupportedCultureMap extends BaseObjectMap
{
    public function initialize()
    {

        $this->object_class =  'Model\Bobinaudio\Transfo\SupportedCulture';
        $this->object_name  =  'transfo.supported_culture';

        $this->addField('culture', 'bpchar');
        $this->addField('label', 'varchar');

        $this->pk_fields = array('culture');
    }
}
