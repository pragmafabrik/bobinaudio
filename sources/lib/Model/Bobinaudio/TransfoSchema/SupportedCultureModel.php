<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Model\Bobinaudio\TransfoSchema\AutoStructure\SupportedCulture as SupportedCultureStructure;
use Model\Bobinaudio\TransfoSchema\SupportedCulture;

/**
 * SupportedCultureModel
 *
 * Model class for table supported_culture.
 *
 * @see Model
 */
class SupportedCultureModel extends Model
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
        $this->structure = new SupportedCultureStructure;
        $this->flexible_entity_class = "\Model\Bobinaudio\TransfoSchema\SupportedCulture";
    }
}
