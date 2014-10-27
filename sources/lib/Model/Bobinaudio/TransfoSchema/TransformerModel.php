<?php

namespace Model\Bobinaudio\TransfoSchema;

use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\Model;

use PommProject\Foundation\Where;
use PommProject\Foundation\Pager;

use Model\Bobinaudio\TransfoSchema\Transformer;
use Model\Bobinaudio\TransfoSchema\AutoStructure\Transformer as TransformerStructure;

/**
 * TransformerModel
 *
 * Base Model for all transformers.
 *
 * @see Model
 */
class TransformerModel extends Model
{
    protected $culture = 'en';

    public function __construct()
    {
        $this->flexible_entity_class = '\Model\Bobinaudio\TransfoSchema\Transformer';
        $this->structure             = new TransformerStructure;
    }

    /**
     * setCulture
     *
     * A short description here
     *
     * @access public
     * @param  string $culture
     * @return string
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * getCulture
     *
     * Return the current culture.
     *
     * @access public
     * @return string
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * createProjection
     *
     * Default projection
     *
     * @access protected
     * @return Projection
     */
    protected function createProjection()
    {
        return parent::createProjection()
            ->unsetField('hook_phrase_i18n')
            ->unsetField('description_i18n')
            ->setField('hook_phrase', sprintf("%%hook_phrase_i18n->'%s'", $this->culture), 'text')
            ->setField('description', sprintf("%%description_i18n->'%s'", $this->culture), 'text')
            ;
    }

    public function paginateFindWithDimensionWhere(Where $where, $suffix = '', $rpp, $page = 1)
    {
        $where = (new Where())->andWhere($where);
        $ei_model = $this->getSession()->getClientUsingPooler('model', '\Model\Bobinaudio\TransfoSchema\EiDimensionModel');
        $sql   = <<<SQL
select
    :projection
from
    :transformer_table t
        join :ei_table ei using (ei_dimension_id)
where
    :where
:suffix
offset :offset limit :limit
SQL;
        $projection = $this->createProjection()
            ->setField('dimension' ,'ei.ref', 'varchar')
            ;

        $sql = strtr(
            $sql,
            [
                ':projection'        => $projection->formatFieldsWithFieldAlias('t'),
                ':transformer_table' => $this->getStructure()->getRelation(),
                ':ei_table'          => $ei_model->getStructure()->getRelation(),
                ':where'             => $where->__toString(),
                ':suffix'            => $suffix,
                ':offset'            => (int) ($rpp * ($page - 1)),
                ':limit'             => (int) $rpp,
            ]
        );

        $iterator = $this->query($sql, $where->getValues(), $projection);

        return new Pager($iterator, $this->countWhere($where), $rpp, $page);
    }

    public function quickFindRef($string)
    {
        $sql = 'select :projection from :transformer_table where ref ~* $*';
        $projection = (new Projection())
            ->setField('transformer_id', '%transformer_id', 'uuid')
            ->setField('ref', '%ref', 'varchar')
            ->setField('relation', '%tableoid::regclass', 'regclass')
            ;
        $sql = strtr($sql,
            [
                ':projection'        => $projection,
                ':transformer_table' => $this->getStructure()->getRelation(),
            ]
        );

        return $this->query($sql, [ $string ], $projection);
    }
}
