# KyoushuFoundationBundle

Integrates Foundation into Symfony

The master brach is currently a development build, and should not be used for live projects.

## Installation

Add bundle to composer.json

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Kyoushu/FoundationBundle.git"
        }
    ],
    "require": {
        "php": ">=5.3.2",
        "symfony/symfony": "~2.1",
        "_comment": "your other packages",
    
        "kyoushu/foundation-bundle": "dev-master"
    }

Add KyoushuFoundationBundle to application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Kyoushu\FoundationBundle\KyoushuFoundationBundle($this),
            // ...
        );
    }

Update config.yml to include the following lines.

    # app/config/config.yml
    assetic:
        bundles:[ 'KyoushuFoundationBundle' ]
        filters:
            scssphp: ~

## Optional Configuration

The following options can be configured if required

    # app/config/config.yml
    kyoushu_foundation:
    
        # Forces Assetic to rebuild CSS on each request when true (default value)
        # This setting doesn't affect the behaviour of assetic:dump.
        force_rebuild_stylesheets: ~