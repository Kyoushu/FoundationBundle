<?php

namespace Kyoushu\FoundationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Kyoushu\FoundationBundle\DependencyInjection\Compiler\AsseticCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\KernelInterface;

class KyoushuFoundationBundle extends Bundle
{
    
    protected $kernel;
    
    public function __construct(KernelInterface $kernel){
        $this->kernel = $kernel;
    }
    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AsseticCompilerPass($this->kernel));
    }
    
}
