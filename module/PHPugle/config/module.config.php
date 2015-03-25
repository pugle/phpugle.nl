<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
session_start();
return array (
    'router' => array (
        'routes' => array(
            'index' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array (
                        '__NAMESPACE__' => 'PHPugle\Controller',
                        'controller'    => 'Index',
                            'action'        => 'index'
                    ),
                ),
            ),
            'posts' => array(
                'type' => 'Zend\Mvc\Router\Http\Regex',
                'options' => array(
                    'regex' => '/(?<post_url>[0-9]{4}\/[0-9]{2}\/[0-9]{2}\/[a-zA-Z0-9_-]+)',
                    //'regex' => '/(?<year>[0-9]{4})/(?<month>[0-9]{2})/(?<day>[0-9]{2})/(?<title>[a-zA-Z0-9_-]+)',
                    'defaults' => array(
                        '__NAMESPACE__' => 'PHPugle\Controller',
                        'controller' => 'Index',
                        'action' => 'post',
                        'post_url' => false
                        /*'year' => false,
                        'month' => false,
                        'day' => false,
                        'title' => false*/
                    ),
                    /*'spec' => '/%year%/%month%/%day%/%title%',*/
                    'spec' => '/%post_url%',
                )
            ),

        ),
    ),

    'service_manager' => array (
        'factories' => array (
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
        'aliases' => array(
        )
    ),

    'translator'      => array (
        'locale'                    => 'nl_NL',
        'translation_file_patterns' => array (
            array (
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'controllers'     => array (
        'invokables' => array (
            'PHPugle\Controller\Index' => 'PHPugle\Controller\IndexController',
        ),
    ),

    'view_manager'    => array (
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error_ext',
        'template_map'             => array (
            'layout/layout'          => __DIR__ . '/../view/layout/layout.phtml',
            'layout/html'          => __DIR__ . '/../view/layout/layout.html.php',
            'layout/json'          => __DIR__ . '/../view/layout/layout.json.php',
            'md/index'           => __DIR__ . '/../view/phpugle/index/index.html.md',
            'md/post'           => __DIR__ . '/../view/phpugle/post.html.md',
            'html/index'           => __DIR__ . '/../view/phpugle/index/index.html.phtml',
            'error_ext'             => __DIR__ . '/../view/error/error_ext.phtml'

        ),
        'template_path_stack'      => array (
            __DIR__ . '/../view',
        ),
    ),
);
