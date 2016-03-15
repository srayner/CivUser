<?php

namespace CivUser\Adapter;

use Zend\Authentication\Adapter\Ldap;
use CivUser\Model\User;

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
        // Grab the account object from LDAP.
        $fields = array('userprincipalname', 'mail', 'displayname');
        $stdObject = $this->getAccountObject($fields);
        
        // Extract username and domain from userprinciplename property.
        $arr = explode("@", $stdObject->userprincipalname);
        
        // Hydrate and return a User object.
        $identityObject = New User();
        $identityObject->setUsername($arr[0]);
        $identityObject->setDomain($arr[1]);
        $identityObject->setPassword('');
        if (property_exists($stdObject, 'mail')) {
            $identityObject->setEmailAddress($stdObject->mail);
        }
        $identityObject->setDisplayName($arr[0]);
        if (property_exists($stdObject, 'mail')) {
            $identityObject->setDisplayName($stdObject->displayname);
        }
        return $identityObject;
    }
}