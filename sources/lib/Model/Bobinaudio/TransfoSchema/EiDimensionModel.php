<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Model\Bobinaudio\TransfoSchema\AutoStructure\EiDimension as EiDimensionStructure;
use Model\Bobinaudio\TransfoSchema\EiDimension;

/**
 * EiDimensionModel
 *
 * Model class for table ei_dimension.
 *
 * @see Model
 */
class EiDimensionModel extends Model
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
        $this->structure = new EiDimensionStructure;
        $this->flexible_entity_class = "\Model\Bobinaudio\TransfoSchema\EiDimension";
    }
}
