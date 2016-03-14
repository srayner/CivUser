<?php

namespace CivUser\Service;

use Zend\Authentication\AuthenticationService as AuthService;

class AuthService
{
    protected $adapter;
    protected $service;
    protected $mapper;
    
    public function __construct($adapter, $mapper)
    {
        $this->mapper = $mapper;
        $this->adapter = $adapter;
        $this->service = new AuthService();
    }

    public function authenticate($credentials)
    {   
        $this->adapter->setIdentity($credentials['username']);
        $this->adapter->setCredential($credentials['password']);
        $result = $this->service->authenticate($this->adapter);
        if ($result->isValid())
        {
            $user = $this->adapter->getIdentityObject();
            if ($user->getDomain() != 'local') {
                $this->mapper->persist($user);
            }
            $storage = $this->service->getStorage();
            $storage->write($user);
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
    
    public function getIdentityObject()
    {
        $storage = $this->service->getStorage();
        return $storage->read();
    }
    
    // for testing
    public function persist($user)
    {
        return $this->mapper->persist($user);
    }
    
    
}
