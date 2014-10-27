<?php

namespace Model;

use PommProject\ModelManager\SessionBuilder;
use PommProject\ModelManager\Converter\PgEntity;

use PommProject\Foundation\Session\Session;

use Model\Bobinaudio\TransfoSchema\Type\TransformerWindingStructure;

class BobinaudioSessionBuilder extends SessionBuilder
{
    protected function postConfigure(Session $session)
    {
        parent::postConfigure($session);
        $converter_holder = $session
            ->getPoolerForType('converter')
            ->getConverterHolder()
            ;

        $converter_holder
            ->registerConverter(
                'TransformerWinding',
                new PgEntity(
                    '\Model\Bobinaudio\TransfoSchema\Type\TransformerWinding',
                    new TransformerWindingStructure()
                ),
                ['transfo.winding', '\Model\Bobinaudio\TransfoSchema\Type\TransformerWinding']
            )
            ;
    }
}
