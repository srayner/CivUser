<?php

namespace CivUser\Service;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;

class AuthService
{
    protected $dbAdapter;
    
    public function __construct($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function authenticate($username, $password)
    {
        $authAdapter = new AuthAdapter(
            $this->dbAdapter,
            'user',
            'username',
            'password'
        );
        
        $authAdapter->setIdentity($username)
                    ->setCredential($password);
        
        $result = $authAdapter->authenticate();
        die(var_dump($result));
    }
    
}
