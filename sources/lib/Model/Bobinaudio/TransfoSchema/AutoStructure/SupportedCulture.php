<?php
/**
 * This file has been automaticaly generated by Pomm Cli package.
 * You MIGHT NOT edit this file as your changes will be lost at next
 * generation.
 */

namespace Model\Bobinaudio\TransfoSchema\AutoStructure;

use PommProject\ModelManager\Model\RowStructure;

/**
 * SupportedCulture
 *
 * Structure class for relation transfo.supported_culture.
 * 
 * Class and fields comments are inspected from table and fields comments.
 * Just add comments in your database and they will appear here.
 * @see http://www.postgresql.org/docs/9.0/static/sql-comment.html
 *
 *
 *
 * @see RowStructure
 */
class SupportedCulture extends RowStructure
{
    /**
     * __construct
     *
     * Structure definition.
     *
     * @access public
     * @return null
     */
    public function __construct()
    {
        $this
            ->setRelation('transfo.supported_culture')
            ->setPrimaryKey(['culture'])
            ->addField('culture', 'bpchar')
            ->addField('label', 'varchar')
            ;
    }
}
