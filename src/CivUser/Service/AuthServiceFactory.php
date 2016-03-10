<?php

namespace CivUser\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use CivUser\Adapter\Table;
use CivUser\Adapter\Ldap;

class AuthServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authAdapter = null;
        
        $config = $serviceLocator->get('Config')['civuser']['adapter'];
        
        if ($config['type'] == 'dbtable') {
            $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
            $authAdapter = new Table($dbAdapter, $config);
        }
        
        if ($config['type'] == 'ldap') {
            $authAdapter = new Ldap($config);
        }

        if (!$authAdapter) {
            throw new Exception('No auth adapter supplied by application configuration.');
        }
        
        return new AuthService($authAdapter);
    }  
}
