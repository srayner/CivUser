<?php

namespace CivUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class ChangepasswordForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setAttributes(array(
            'class' => 'form',
        ));
        
        // Current Password
        $current = new Element\Password('current_password');
        $current->setLabel('Current Password');
        $current->setAttributes(array(
            'class' => 'form-control input-sm',
            'id' => 'current-password-field', 
        ));
        $this->add($current);
        
        // New Password
        $new = new Element\Password('new_password');
        $new->setLabel('New Password');
        $new->setAttributes(array(
            'class' => 'form-control input-sm',
            'id' => 'new-password-field', 
        ));
        $this->add($new);
        
        // Confirm Password
        $confirm = new Element\Password('confirm_password');
        $confirm->setLabel('Confirm Password');
        $confirm->setAttributes(array(
            'class' => 'form-control input-sm',
            'id' => 'confirm-password-field', 
        ));
        $this->add($confirm);
        
        // Submit button.
        $submit = new Element\Submit('submit');
        $submit->setValue('O.K.');
        $submit->setAttributes(array(
            'id'    => 'submit',
            'class' => 'btn btn-sm btn-primary'
        ));
        $this->add($submit);
       
    }
}