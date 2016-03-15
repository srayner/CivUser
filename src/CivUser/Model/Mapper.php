<?php

namespace CivUser\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class Mapper extends TableGateway
{
    public function persist($user)
    {
        if ($user->getDomain() == 'local') {
            return $this->persistLocal();
        }
        return $this->persistDomain();
    }
    
    private function persistLocal($user)
    {
        $hydrator = new ClassMethods;
        $data = $hydrator->extract($user);
        if (!$user->getId()) {
            $result = parent::insert($data);
            $user->setId($this->getLastInsertValue());
            return $result;
        }
        return parent::update($data, $user->getId());
    }
    
    private function persistDomain($user)
    {
        $hydrator = new ClassMethods;
        $data = $hydrator->extract($user);
        
        // Check if this user already exists
        
        // if yes then update
        
        // otherwise insert.
        
    }
}