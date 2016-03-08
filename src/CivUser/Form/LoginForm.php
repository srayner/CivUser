<?php

namespace CivUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setAttributes(array(
            'class' => 'form',
        ));
        
        // Username
        $username = new Element\Text('username'); 
        $username->setLabel('User Name');
        $username->setAttributes(array(
            'class' => 'form-control input-sm',
            'id' => 'username-field',
        )); 
        $this->add($username);
        
        // Password
        $password = new Element\Password('password');
        $password->setLabel('Password');
        $password->setAttributes(array(
            'class' => 'form-control input-sm',
            'id' => 'password-field', 
        ));
        $this->add($password);
        
        // Submit button.
        $submit = new Element\Submit('submit');
        $submit->setValue('Login');
        $submit->setAttributes(array(
            'id'    => 'submit',
            'class' => 'btn btn-sm btn-primary'
        ));
        $this->add($submit);
       
    }
}