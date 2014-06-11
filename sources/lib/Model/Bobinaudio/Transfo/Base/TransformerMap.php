<?php

namespace Model\Bobinaudio\Transfo\Base;

use \Pomm\Object\BaseObjectMap;
use \Pomm\Exception\Exception;

abstract class TransformerMap extends BaseObjectMap
{
    public function initialize()
    {

        $this->object_class =  'Model\Bobinaudio\Transfo\Transformer';
        $this->object_name  =  'transfo.transformer';

        $this->addField('transformer_id', 'uuid');
        $this->addField('ref', 'varchar');
        $this->addField('ei_dimension_id', 'int4');
        $this->addField('weight', 'numeric');
        $this->addField('height', 'int4');
        $this->addField('meta', 'json');
        $this->addField('is_online', 'bool');
        $this->addField('is_on_top', 'bool');
        $this->addField('is_advertised', 'bool');
        $this->addField('public_price', 'numeric');
        $this->addField('special_offer', 'transfo.special_offer');
        $this->addField('display_order', 'int4');
        $this->addField('hook_phrase_i18n', 'public.hstore');
        $this->addField('description_i18n', 'public.hstore');

        $this->pk_fields = array('');
    }
}
