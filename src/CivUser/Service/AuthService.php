<?php

namespace CivUser\Service;

use Zend\Authentication\AuthenticationService;

class AuthService
{
    const PASSWORD_CHANGED = 0;
    const BAD_PASSWORD     = 1;
    const BAD_CONFIRMATION = 2;
    
    protected $adapter;
    protected $service;
    protected $mapper;
    
    public function __construct($adapter, $mapper)
    {
        $this->mapper = $mapper;
        $this->adapter = $adapter;
        $this->service = new AuthenticationService();
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
    
    
    public function changePassword($passwords)
    {
        $identity = $this->getIdentity();
          
        // Grab existing user object from db.
        $user = $this->mapper->findById($identity->getId());
        
        // verify existing password matches.
        if (!password_verify($passwords['current_password'], $user->getPassword())) {
            return BAD_PASSWORD;
        }
        
        // verify new password and confirmation match.
        if ($passwords['new_password'] !== $passwords['confirm_password']) {
            return BAD_CONFIRMATION;
        }
                
        // update password and persist.
        $user->setPassword(password_hash($passwords['new_password'], PASSWORD_DEFAULT));
        $this->mapper->persist($user);
        return PASSWORD_CHANGED;
    }
    
}
