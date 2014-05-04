<?php

namespace Kyoushu\FoundationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class AsseticCompilerPass implements CompilerPassInterface
{
    
    protected $kernel;
    
    public function __construct(KernelInterface $kernel){
        $this->kernel = $kernel;
    }

    public function process(ContainerBuilder $container)
    {
        
        $kernelRootDir = $this->kernel->getRootDir();
        
        $foundationScssImportPath = sprintf('%s/../vendor/zurb/foundation/scss', $kernelRootDir);
        $bundleScssImportPath = sprintf('%s/../src/Kyoushu/FoundationBundle/Resources/scss', $kernelRootDir);
        
        $scssFilterDefinition = $container->getDefinition('assetic.filter.scssphp');
        $scssFilterDefinition->addMethodCall('addImportPath', array($foundationScssImportPath));
        $scssFilterDefinition->addMethodCall('addImportPath', array($bundleScssImportPath));
        
    }
}