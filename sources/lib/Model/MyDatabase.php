<?php #sources/lib/Model/MyDatabase.php

namespace Model;

use \Pomm\Connection\Database;
use \Pomm\Converter\PgRow;
use \Pomm\Object\RowStructure;

class MyDatabase extends Database
{
    protected function initialize()
    {
        parent::initialize();

        $this->registerConverter('TransformerWinding', new PgRow($this, new RowStructure(['current' => 'int4', 'impedance' => 'int4', 'voltage' => 'int4[]']), '\Model\Type\Transfo\Winding'), [ 'transfo.winding' ]);
        $this->registerConverter('HStore', new \Pomm\Converter\PgHStore(), array('public.hstore'));

        // register configuration or converters here
    }
}
