<?php

namespace CivUser\Adapter;

use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use CivUser\Model\User;

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
        $this->getDbSelect()->where(array('domain' => 'local'));
    }
    
    public function getIdentityObject()
    {
        $fields = array('id', 'username', 'email_address', 'display_name');
        $stdObject = $this->getResultRowObject($fields);
        $identityObject = New User();
        $identityObject->setId($stdObject->id);
        $identityObject->setUsername($stdObject->username);
        $identityObject->setDomain('local');
        $identityObject->setEmailAddress($stdObject->email_address);
        $identityObject->setDisplayName($stdObject->display_name);
        return $identityObject;
    }
}
