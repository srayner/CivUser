<?php

namespace CivUser\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ClassMethods;

use CivUser\Adapter\TableAdapter;
use CivUser\Adapter\LdapAdapter;
use CivUser\Model\Mapper;
use CivUser\Model\User;


class AuthServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        
        // Create the auth adapter.
        $authAdapter = null;
        $adapterConfig     = $serviceLocator->get('Config')['civuser']['adapter'];   
        if ($adapterConfig['type'] == 'dbtable') {
            $authAdapter = new TableAdapter($dbAdapter, $adapterConfig);
        }
        if ($adapterConfig['type'] == 'ldap') {
            $authAdapter = new LdapAdapter($adapterConfig);
        }
        if (!$authAdapter) {
            throw new \Exception('No auth adapter supplied by application configuration.');
        }
        
        // Create the persistance mapper.
        $mapperConfig = $serviceLocator->get('Config')['civuser']['persistance'];
        $hydratingResultSet = New HydratingResultSet(New ClassMethods, New User);
        $mapper = new Mapper($mapperConfig['table'], $dbAdapter, null, $hydratingResultSet);
        
        // Return the service.
        return new AuthService($authAdapter, $mapper);
    }  
}
