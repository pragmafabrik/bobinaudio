<?php

namespace Model\Bobinaudio\Transfo;

use Model\Bobinaudio\Transfo\Base\AdminMap as BaseAdminMap;
use Model\Bobinaudio\Transfo\Admin;
use \Pomm\Exception\Exception;
use \Pomm\Query\Where;

class AdminMap extends BaseAdminMap
{
    public function login($login, $password)
    {
        $where = Where::create('login = $*', [ $login ])
            ->andWhere('password = crypt($*, password)', [ $password ]);

        return $this->findWhere($where)->current();
    }
}
