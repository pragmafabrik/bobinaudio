<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Model\Bobinaudio\TransfoSchema\AutoStructure\Admin as AdminStructure;
use Model\Bobinaudio\TransfoSchema\Admin;

/**
 * AdminModel
 *
 * Model class for table admin.
 *
 * @see Model
 */
class AdminModel extends Model
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
        $this->structure = new AdminStructure;
        $this->flexible_entity_class = "\Model\Bobinaudio\TransfoSchema\Admin";
    }
}
