<?php

namespace Kyoushu\FoundationBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Kyoushu\FoundationBundle\AsseticController;

class AsseticListener{
    
    private $asseticController;
    private $forceRebuildStylesheets;
    
    public function __construct(AsseticController $asseticController){
        $this->asseticController = $asseticController;
        $this->forceRebuildStylesheets = false;
    }
    
    public function setForceRebuildStylesheets($forceRebuildStylesheets){
        $this->forceRebuildStylesheets = (bool)$forceRebuildStylesheets;
        return $this;
    }
    
    public function onController(FilterControllerEvent $event){
        
        if(!$this->forceRebuildStylesheets) return;
        
        $controller = $event->getController();
        $request = $event->getRequest();
        
        // Assetic doesn't understand how to cache SCSS properly, so we'll force
        // the site to re-generate CSS every time (if the assetic controller is
        // enabled in config_dev.yml)
        
        if(get_class($controller[0]) === 'Symfony\Bundle\AsseticBundle\Controller\AsseticController'){
            if($controller[1] === 'render'){
                
                $uri = $request->getUri();
                
                if(preg_match('/\.css$/i', $uri)){
                    $event->setController(array(
                        $this->asseticController,
                        'render'
                    ));
                }
                
            }
        }
        
    }
    
}