<?php

namespace CivUser\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter;
use Zend\Authentication\Adapter\Ldap;

class AuthServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authAdapter = null;
        
        $config = $serviceLocator->get('Config')['civuser']['adapter'];
        
        if ($config['type'] == 'dbtable') {
            
            $callback = function ($passwordInDatabase, $passwordProvided) {
                return password_verify($passwordProvided, $passwordInDatabase);
            };
        
            $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
            $authAdapter = new CallbackCheckAdapter(
              $dbAdapter,
              $config['table'],
              $config['identifier_field'],
              $config['credential_field'],
              $callback   
            );
        }
        
        if ($config['type'] == 'ldap') {
            
            $authAdapter = new Ldap(array(
                'server1' => array(
                    'host'                   =>  $config['host'],
                    'port'                   =>  $config['port'],
                    'useStartTls'            =>  $config['useStartTls'],
                    'accountDomainName'      =>  $config['accountDomainName'],
                    'accountDomainNameShort' =>  $config['accountDomainNameShort'],
                    'accountCanonicalForm'   =>  $config['accountCanonicalForm'],
                    'baseDn'                 =>  $config['baseDn']
                ),
               
            ));
              
        }
        
        if (!$authAdapter) {
            throw new Exception('No auth adapter supplied by application configuration.');
        }
        
        return new AuthService($authAdapter);
    }  
}
