<?php

namespace Kyoushu\FoundationBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Kyoushu\FoundationBundle\Controller\AsseticController;

class AsseticListener{
    
    private $asseticController;
    
    public function __construct(AsseticController $asseticController){
        $this->asseticController = $asseticController;
    }
    
    public function onController(FilterControllerEvent $event){
        
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