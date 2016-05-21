<?php

namespace CivUser\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Identity extends AbstractHelper
{
    protected $authService;
    
    public function __construct($authService)
    {
        $this->authService = $authService;
    }
    
    public function __invoke()
    {
        if ($this->authService->hasIdentity()) {
            return $this->authService->getIdentity();
        } else {
            return false;
        }
    }   
}