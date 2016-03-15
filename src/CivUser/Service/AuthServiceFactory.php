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
        
        $hydratingResultSet = New HydratingResultSet(New ClassMethods, New User);
        $mapper = new Mapper('civ_user', $dbAdapter, null, $hydratingResultSet);
        return new AuthService($authAdapter, $mapper);
    }  
}
