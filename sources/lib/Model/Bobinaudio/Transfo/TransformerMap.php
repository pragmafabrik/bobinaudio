<?php

namespace Model\Bobinaudio\Transfo;

use Model\Bobinaudio\Transfo\Base\TransformerMap as BaseTransformerMap;
use Model\Bobinaudio\Transfo\Transformer;
use \Pomm\Exception\Exception;
use \Pomm\Query\Where;

class TransformerMap extends BaseTransformerMap
{
    protected $culture = 'fr';

    public function getSelectFields($alias = null)
    {
        $fields = parent::getSelectFields($alias);
        $fields['hook_phrase'] = sprintf("%s->'%s'", $this->aliasField('hook_phrase_i18n', $alias), $this->culture);
        $fields['description'] = sprintf("%s->'%s'", $this->aliasField('description_i18n', $alias), $this->culture);
        unset($fields['hook_phrase_i18n'], $fields['description_i18n']);

        return $fields;
    }

    public function setCulture($culture)
    {
        $this->culture = $culture;
    }

    public function getCulture()
    {
        return $this->culture;
    }

    protected function getWithDimensionQuery($suffix = '')
    {
        $sql = <<<SQL
select
  :transfo_fields,
  (select ei.ref from :ei_table ei where ei.ei_dimension_id = transfo.ei_dimension_id) as dimension
from
  :transfo_table transfo
where
  :where 
$suffix
SQL;

        $sql = strtr($sql, [
            ':transfo_fields' => $this->formatFieldsWithAlias('getSelectFields', 'transfo'),
            ':transfo_table' => $this->getTableName(),
            ':ei_table' => $this->connection->getMapFor('\Model\Bobinaudio\Transfo\EiDimension')->getTableName(),
        ]);

        return $sql;
    }

    public function findWithDimension($where, Array $params = [], $suffix = '')
    {
        if ($where instanceOf Where)
        {
            $params = $where->getParams();
        }

        $sql = strtr($this->getWithDimensionQuery($suffix),
            [
                ':where' => $where
            ]);

        return $this->query($sql, $params);
    }

    public function paginateFindWithDimensionWhere($where, Array $params, $suffix = '', $rpp, $page = 1)
    {
        if ($where instanceOf Where)
        {
            $params = $where->getParams();
        }

        $sql = strtr($this->getWithDimensionQuery($suffix),
            [
                ':where' => $where
            ]);

        return $this->paginateQuery($sql, sprintf('select count(*) from %s', $this->getTableName()), $params, $rpp, $page);
    }

    public function findForRefSearch($string)
    {
        $sql = 'select transformer_id, ref, tableoid::regclass from :transformer_table where ref like $*';
        $sql = strtr($sql, [ 'transformer_table' => $this->getTableName() ]);

        return $this->query($sql [sprintf('%s%%', $string)]);
    }
}
