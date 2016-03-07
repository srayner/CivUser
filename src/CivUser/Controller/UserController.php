<?php

namespace CivUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController
{
    public function loginAction()
    {
        $form = $this->getServiceLocator()->get('CivUser\LoginForm');
        return array(
            'form' => $form
        );
    }
}

