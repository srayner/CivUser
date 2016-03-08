<?php

namespace CivUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController
{
    public function loginAction()
    {
        $form = $this->getServiceLocator()->get('CivUser\LoginForm');
        
        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service = $this->getServiceLocator()->get('CivUser\AuthService');
                $credentials = $form->getData();
                $username = $credentials['username'];
                $password = $credentials['password'];
                $service->authenticate($username, $password);
            }
        }
        
        return array(
            'form' => $form
        );
    }
}

