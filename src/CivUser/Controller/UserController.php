<?php

namespace CivUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController
{
    public function profileAction()
    {
        $service = $this->getServiceLocator()->get('CivUser\AuthService');
        if (!$service->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        //die(var_dump($service->getIdentity()));
        return array();   
    }
    
    public function loginAction()
    {   
        $form = $this->getServiceLocator()->get('CivUser\LoginForm');
        $message = null;
        $request = $this->getRequest();
        if($request->isPost()) {
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service = $this->getServiceLocator()->get('CivUser\AuthService');
                $credentials = $form->getData();
                if ($service->authenticate($credentials)) {
                    // redirect
                    return $this->redirect()->toRoute('profile');
                }
                $message = 'Login failed. Invalid credentials.';
            }
        }
        
        return array(
            'form' => $form,
            'message' => $message
        );
    }
    
    public function logoutAction()
    {
        $service = $this->getServiceLocator()->get('CivUser\AuthService');
        $service->clearIdentity();
        return $this->redirect()->toRoute('login');
    }
}

