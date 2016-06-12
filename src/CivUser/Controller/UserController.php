<?php

namespace CivUser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

class UserController extends AbstractActionController
{
    public function profileAction()
    {
        $service = $this->getServiceLocator()->get('CivUser\AuthService');
        if (!$service->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        
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
                    return $this->redirect()->toUrl($this->redirectUrl());
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
    
    public function changepasswordAction()
    {
        $service = $this->getServiceLocator()->get('CivUser\AuthService');
        if (!$service->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }
        
        $form = $this->getServiceLocator()->get('CivUser\ChangepasswordForm');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                
                $result = $service->changepassword($request->getPost());
                
                // If ok, then redirect to profile.
                if ($result == $service::PASSWORD_CHANGED) {
                    // Redirect;
                    return $this->redirect()->toRoute('profile');
                }
                
            }
        }
        return array(
            'form' => $form
        );
    }
    
    private function redirectUrl()
    {
        $container = new Container('redirect');
        $result = '/profile';
        if ($container->url) {
            $result = $container->url;
            $container->url = null;
        }
        return $result;
    }
    
}

