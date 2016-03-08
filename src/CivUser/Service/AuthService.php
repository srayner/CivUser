<?php

namespace CivUser\Service;

use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter as AuthAdapter;
use Zend\Authentication\AuthenticationService as AuthService;
use Zend\Authentication\Result as Result;

class AuthService
{
    protected $adapter;
    protected $service;
    
    public function __construct($dbAdapter)
    {
        $callback = function ($passwordInDatabase, $passwordProvided) {
            return password_verify($passwordProvided, $passwordInDatabase);
        };
        
        $this->adapter = new AuthAdapter(
            $dbAdapter,
            'civ_user',
            'username',
            'password',
            $callback
        );
        $this->service = new AuthService();
    }

    public function authenticate($identity, $credential)
    {   
        $this->adapter->setIdentity($identity)
                      ->setCredential($credential);
        $result = $this->service->authenticate($this->adapter);
        return ($result->getCode() == Result::SUCCESS);
    }
    
    public function hasIdentity()
    {
        return $this->service->hasIdentity();
    }
    
}
