<?php

namespace CivUser\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProfileLinkFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceManager
     * @return Identity
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $locator = $serviceManager->getServiceLocator();
        $config = $locator->get('config')['civuser']['profile_link'];
        return new ProfileLink($locator->get('CivUser\AuthService'), $config);
    }   
}