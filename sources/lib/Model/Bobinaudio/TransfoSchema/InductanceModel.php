<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Model\Bobinaudio\TransfoSchema\AutoStructure\Inductance as InductanceStructure;
use Model\Bobinaudio\TransfoSchema\TransformerModel;
use Model\Bobinaudio\TransfoSchema\Inductance;

/**
 * InductanceModel
 *
 * Model class for table inductance.
 *
 * @see Model
 */
class InductanceModel extends TransformerModel
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
        $this->structure             = new InductanceStructure;
        $this->flexible_entity_class = "\Model\Bobinaudio\TransfoSchema\Inductance";
    }
}
