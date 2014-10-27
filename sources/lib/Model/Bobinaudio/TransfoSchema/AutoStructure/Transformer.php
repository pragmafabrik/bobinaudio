<?php
/**
 * This file has been automaticaly generated by Pomm Cli package.
 * You MIGHT NOT edit this file as your changes will be lost at next
 * generation.
 */

namespace Model\Bobinaudio\TransfoSchema\AutoStructure;

use PommProject\ModelManager\Model\RowStructure;

/**
 * Transformer
 *
 * Structure class for relation transfo.transformer.
 * 
 * Class and fields comments are inspected from table and fields comments.
 * Just add comments in your database and they will appear here.
 * @see http://www.postgresql.org/docs/9.0/static/sql-comment.html
 *
 *
 *
 * @see RowStructure
 */
class Transformer extends RowStructure
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
            ->setRelation('transfo.transformer')
            ->setPrimaryKey([])
            ->addField('transformer_id', 'uuid')
            ->addField('ref', 'varchar')
            ->addField('ei_dimension_id', 'int4')
            ->addField('weight', 'numeric')
            ->addField('height', 'int4')
            ->addField('meta', 'json')
            ->addField('is_online', 'bool')
            ->addField('is_on_top', 'bool')
            ->addField('is_advertised', 'bool')
            ->addField('display_order', 'int4')
            ->addField('hook_phrase_i18n', 'public.hstore')
            ->addField('description_i18n', 'public.hstore')
            ;
    }
}
