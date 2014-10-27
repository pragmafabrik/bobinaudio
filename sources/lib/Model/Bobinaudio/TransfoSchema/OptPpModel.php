<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Model\Bobinaudio\TransfoSchema\AutoStructure\OptPp as OptPpStructure;
use Model\Bobinaudio\TransfoSchema\OptPp;

/**
 * OptPpModel
 *
 * Model class for table opt_pp.
 *
 * @see Model
 */
class OptPpModel extends Model
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
        $this->structure = new OptPpStructure;
        $this->flexible_entity_class = "\Model\Bobinaudio\TransfoSchema\OptPp";
    }
}
