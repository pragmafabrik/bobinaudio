<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Model\Bobinaudio\TransfoSchema\AutoStructure\Psu as PsuStructure;
use Model\Bobinaudio\TransfoSchema\TransformerModel;
use Model\Bobinaudio\TransfoSchema\Psu;

/**
 * PsuModel
 *
 * Model class for table psu.
 *
 * @see Model
 */
class PsuModel extends TransformerModel
{
    use WriteQueries;

    /**
     * __construct()
     *
     * Model constructor
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->structure = new PsuStructure;
        $this->flexible_entity_class = "\Model\Bobinaudio\TransfoSchema\Psu";
    }
}
