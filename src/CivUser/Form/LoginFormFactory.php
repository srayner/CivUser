<?php

namespace CivUser\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class LoginFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new LoginForm();
        $inputFilter = new UserInputFilter();
        $form->setHydrator(new ClassMethods)
             ->setInputFilter($inputFilter);
        return $form; 
    }
}