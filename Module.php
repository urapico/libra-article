<?php

namespace LibraArticle;

use Zend\ModuleManager\ModuleManager,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\ModuleEvent;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    protected static $options;

    public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->attach('loadModules.post', array($this, 'setOptions'));
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'formCkeditor' => 'LibraArticle\View\Helper\FormCkeditor',
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                array(
                    'CKEditor' => 'public/vendor/ckeditor/ckeditor.php',
                    'CKFinder' => 'public/vendor/ckfinder/ckfinder.php',
                ),
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function setOptions(ModuleEvent $e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        static::$options = $config['libra_article'];
    }

    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        return static::$options[$option];
    }

    /**
     * executes on boostrap
     * @param \Zend\Mvc\MvcEvent $e
     * @return null
     */
    public function onBootstrap(MvcEvent $e)
    {
    }

}
