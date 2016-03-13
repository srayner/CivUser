<?php

namespace CivUser\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class Mapper extends TableGateway
{
    public function persist($user)
    {
        $hydrator = new ClassMethods;
        $data = $hydrator->extract($user);
        if (!$user->getId()) {
            return parent::insert($data);
        }
        return parent::update($data, $user->getId());
    }
}