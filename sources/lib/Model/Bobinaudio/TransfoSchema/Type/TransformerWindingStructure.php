<?php

namespace Model\Bobinaudio\TransfoSchema\Type;

use PommProject\ModelManager\Model\RowStructure;

class TransformerWindingStructure extends RowStructure
{
    /**
     * __construct
     *
     * TransformerWindingStructure definition.
     *
     * @access public
     * @return null
     */
    public function __construct()
    {
        $this
            ->setRelation('transfo.winding')
            ->addField('current',  'int4')
            ->addField('impedance','int4')
            ->addField('voltage',  'int4[]')
            ;
    }
}
