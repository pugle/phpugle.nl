<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace PHPugle;

use Ciconia\Ciconia;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
            'namespaces' => array(
                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'markdownService' => function ($sm) {
                    return new Service\MarkdownService($sm);
                },
                'ciconia' => function ($sm) {
                    $ciconia = new Ciconia();
                    $ciconia->addExtension(new \Ciconia\Extension\Gfm\FencedCodeBlockExtension());
                    $ciconia->addExtension(new \Ciconia\Extension\Gfm\TaskListExtension());
                    $ciconia->addExtension(new \Ciconia\Extension\Gfm\InlineStyleExtension());
                    $ciconia->addExtension(new \Ciconia\Extension\Gfm\WhiteSpaceExtension());
                    $ciconia->addExtension(new \Ciconia\Extension\Gfm\TableExtension());
                    $ciconia->addExtension(new \Ciconia\Extension\Gfm\UrlAutoLinkExtension());
                    return $ciconia;
                },
            )
        );
    }

    /**
     * Set up dependency injection for view helpers
     *
     * @param void
     * @return array
     */
    public function getViewHelperConfig() {
        return array(
            'factories' => array(
               /*  'viewHelper' => function($sm) {
                    return new View\Helper\ViewHelper($sm->getServiceLocator());
                },
                'shareHelper' => function($sm) {
                    return new View\Helper\ShareHelper();
                }, */
            ),
        );
    }
}
