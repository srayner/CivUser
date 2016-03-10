<?php

namespace CivUser\Service;

use Zend\Authentication\AuthenticationService as AuthService;

class AuthService
{
    protected $adapter;
    protected $service;
    protected $identity;
    
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
        $this->service = new AuthService();
    }

    public function authenticate($credentials)
    {   
        $this->adapter->setIdentity($credentials['username']);
        $this->adapter->setCredential($credentials['password']);
        $result = $this->service->authenticate($this->adapter);
        
        if ($result->isValid()) {
            if (is_a($this->adapter, 'Zend\Authentication\Adapter\Ldap')) {
                $fields = array('samaccountname', 'mail', 'displayname');
                die(var_dump($this->adapter->getAccountObject($fields)));
            }
            if (is_a($this->adapter, 'Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter')) {
                $fields = array('username', 'email', 'display_name');
                die(var_dump($this->adapter->getResultRowObject($fields)));
            }
        }
        return $result->isValid();
    }
    
    public function hasIdentity()
    {
        return $this->service->hasIdentity();
    }
    
    public function clearIdentity()
    {
        $this->service->clearIdentity();
    }
    
    public function getIdentity()
    {
        return $this->service->getIdentity();
    }
    
    
}
