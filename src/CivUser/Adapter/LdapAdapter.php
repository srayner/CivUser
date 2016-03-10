<?php

namespace CivUser\Adapter;

use Zend\Authentication\Adapter\Ldap;

class LdapAdapter extends Ldap
{
    public function __construct($config)
    {
        $callback = function ($passwordInDatabase, $passwordProvided) {
            return password_verify($passwordProvided, $passwordInDatabase);
        };
        
        parent::__construct(array(
            'server1' => array(
                'host'                   =>  $config['host'],
                'port'                   =>  $config['port'],
                'useStartTls'            =>  $config['useStartTls'],
                'accountDomainName'      =>  $config['accountDomainName'],
                'accountDomainNameShort' =>  $config['accountDomainNameShort'],
                'accountCanonicalForm'   =>  $config['accountCanonicalForm'],
                'baseDn'                 =>  $config['baseDn']
            )
        )); 
    }
    
    public function getIdentityObject()
    {
        $fields = array('id', 'username', 'email', 'display_name');
        $stdObject = $this->adapter->getAccountObject($fields);
        $identityObject = New User();
        $identityObject->id            = $stdObject->id;
        $identityObject->username      = $stdObject->username;
        $identityObject->email         = $stdObject->email;
        $identityObject->display_name  = $stdObject->display_name;
        return $identityObject;
    }
}