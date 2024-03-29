<?php
/**
 * This file has been automaticaly generated by Pomm Cli package.
 * You MIGHT NOT edit this file as your changes will be lost at next
 * generation.
 */

namespace Model\Bobinaudio\TransfoSchema\AutoStructure;

use PommProject\ModelManager\Model\RowStructure;

/**
 * Admin
 *
 * Structure class for relation transfo.admin.
 * 
 * Class and fields comments are inspected from table and fields comments.
 * Just add comments in your database and they will appear here.
 * @see http://www.postgresql.org/docs/9.0/static/sql-comment.html
 *
 *
 *
 * @see RowStructure
 */
class Admin extends RowStructure
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
            ->setRelation('transfo.admin')
            ->setPrimaryKey(['login'])
            ->addField('login', 'varchar')
            ->addField('last_logon', 'timestamp')
            ->addField('password', 'text')
            ;
    }
}
