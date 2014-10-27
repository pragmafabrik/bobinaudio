<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Model\Bobinaudio\TransfoSchema\AutoStructure\OptSe as OptSeStructure;
use Model\Bobinaudio\TransfoSchema\OptSe;

/**
 * OptSeModel
 *
 * Model class for table opt_se.
 *
 * @see Model
 */
class OptSeModel extends Model
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
        $this->structure = new OptSeStructure;
        $this->flexible_entity_class = "\Model\Bobinaudio\TransfoSchema\OptSe";
    }
}
