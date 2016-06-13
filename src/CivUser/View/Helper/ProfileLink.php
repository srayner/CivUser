<?php

namespace CivUser\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ProfileLink extends AbstractHelper
{
    protected $authService;
    protected $config;
    
    public function __construct($authService, $config)
    {
        $this->authService = $authService;
        $this->config = $config;
    }
    
    public function __invoke()
    {
        if ($this->authService->hasIdentity()) {
            $text = $this->authService->getIdentity()->getDisplayName(); 
            $link = $this->view->url('profile'); 
        } else {
            $text = 'Login';
            $link = $this->view->url('login');
        }
        
        $class = $this->config['class'];
        
        $result = "<a class=\"$class\" href=\"$link\">$text</a>";
        return $result;
    }   
}