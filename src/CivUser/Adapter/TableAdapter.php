<?php

namespace CivUser\Adapter;

use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;

class TableAdapter extends CallbackCheckAdapter
{
    public function __construct($dbAdapter, $config)
    {
        $callback = function ($passwordInDatabase, $passwordProvided) {
            return password_verify($passwordProvided, $passwordInDatabase);
        };
        
        parent::__construct(
            $dbAdapter,$config['table'],
            $config['identifier_field'],
            $config['credential_field'],
            $callback
        ); 
    }
    
    public function getIdentityObject()
    {
        $fields = array('username', 'email', 'display_name');
        $stdObject = $this->adapter->getResultRowObject($fields);
        $identityObject = New User();
        $identityObject->username      = $stdObject->username;
        $identityObject->email         = $stdObject->email;
        $identityObject->display_name  = $stdObject->display_name;
        return $identityObject;
    }
}