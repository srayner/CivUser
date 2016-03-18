<?php

namespace CivUser\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class Mapper extends TableGateway
{
    
    public function findById($id)
    {
        return $this->select(array('id' => $id))->current();
    }
    
    public function persist($user)
    {
        if ($user->getDomain() == 'local') {
            return $this->persistLocal($user);
        }
        return $this->persistDomain($user);
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
        
        // Check if this user already exists
        $result = $this->select(array(
                           'domain' => $user->getDomain(),
                           'username' => $user->getUserName()
                       ));
        $object = $result->current();
        
        // if yes then update
        if ($object) {
            $user->setId($object->getId());
            $hydrator = new ClassMethods;
            $data = $hydrator->extract($user);
            return parent::update($data, array('id' => $user->getId()));
        }
        
        // otherwise insert.
        $hydrator = new ClassMethods;
        $data = $hydrator->extract($user);
        $result = parent::insert($data);
        $user->setId($this->getLastInsertValue());
        return $result;
    }
}