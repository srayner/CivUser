<?php

namespace CivUser\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use CivUser\Adapter\TableAdapter;
use CivUser\Adapter\LdapAdapter;
use CivUser\Model\Mapper;


class AuthServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authAdapter = null;
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        
        $config = $serviceLocator->get('Config')['civuser']['adapter'];
        
        if ($config['type'] == 'dbtable') {
            $authAdapter = new TableAdapter($dbAdapter, $config);
        }
        
        if ($config['type'] == 'ldap') {
            $authAdapter = new LdapAdapter($config);
        }

        if (!$authAdapter) {
            throw new Exception('No auth adapter supplied by application configuration.');
        }
        
        $mapper = new Mapper('user', $dbAdapter);
        return new AuthService($authAdapter, $mapper);
    }  
}
