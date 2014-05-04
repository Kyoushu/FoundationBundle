<?php

namespace Kyoushu\FoundationBundle\Controller;

use Assetic\Factory\LazyAssetManager;
use Symfony\Component\HttpFoundation\Response;

class AsseticController{
    
    private $am;
    
    public function __construct(LazyAssetManager $am){
        $this->am = $am;
    }
    
    public function render($name, $pos = null){
        
        if (!$this->am->has($name)) {
            throw new NotFoundHttpException(sprintf('The "%s" asset could not be found.', $name));
        }
        
        $asset = $this->am->get($name);
        if (null !== $pos && !$asset = $this->findAssetLeaf($asset, $pos)) {
            throw new NotFoundHttpException(sprintf('The "%s" asset does not include a leaf at position %d.', $name, $pos));
        }
        
        $response = new Response();
        $response->setExpires(new \DateTime());
        $response->setContent( $asset->dump() );
        
        return $response;
        
    }
    
    private function findAssetLeaf(\Traversable $asset, $pos){
        $i = 0;
        foreach ($asset as $leaf) {
            if ($pos == $i++) {
                return $leaf;
            }
        }
    }
    
}