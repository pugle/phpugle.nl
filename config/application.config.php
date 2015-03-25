<?php
if(!defined("APPLICATION_ENV")) {
    define("APPLICATION_ENV", getenv("APPLICATION_ENV"));
}

return array(
    'modules' => array(
        'PHPugle'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
            'config/autoload/' . (APPLICATION_ENV ?: 'production') . '/local.config.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);