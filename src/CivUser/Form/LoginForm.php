<?php

namespace CivUser\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setAttributes(array(
            'class' => 'form',
        ));
        
        // Username
        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'User Name',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm',
                'id' => 'username-field',
            ), 
        ));
        
        // Password
        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm',
                'id' => 'password-field',
            ),
        ));
        
        // Submit button.
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'id'    => 'submitbutton',
                'class' => 'btn btn-sm btn-primary'
            ),
        ));
       
    }
}