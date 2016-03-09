<?php

namespace CivUser\Service;

use Zend\Authentication\AuthenticationService as AuthService;
use Zend\Authentication\Result as Result;

class AuthService
{
    protected $adapter;
    protected $service;
    
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
        $this->service = new AuthService();
    }

    public function authenticate($identity, $credential)
    {   
        $this->adapter->setIdentity($identity);
        $this->adapter->setCredential($credential);
        $result = $this->service->authenticate($this->adapter);
        die(var_dump($result));
        return ($result->getCode() == Result::SUCCESS);
    }
    
    public function hasIdentity()
    {
        return $this->service->hasIdentity();
    }
    
}
