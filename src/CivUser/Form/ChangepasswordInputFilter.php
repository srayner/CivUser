<?php

namespace CivUser\Form;

use Zend\InputFilter\InputFilter;

class ChangepasswordInputFilter extends InputFilter
{
    public function __construct()
    {
        // Current Password
        $this->add(array(
            'name'       => 'current_password',
            'required'   => true,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // New Password
        $this->add(array(
            'name'       => 'new_password',
            'required'   => true,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
        
        // Confirm Password
        $this->add(array(
            'name'       => 'confirm_password',
            'required'   => true,
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));
    }
}