<?php

namespace CivUser\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ProfileLink extends AbstractHelper
{
    protected $authService;
    
    public function __construct($authService)
    {
        $this->authService = $authService;
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
        
        $result = "<a href=\"$link\">$text</a>";
        return $result;
    }   
}