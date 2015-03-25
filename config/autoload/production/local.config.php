<?php
ini_set('display_errors', '1');
error_reporting(E_ALL & ~E_STRICT);
return array(
    'caches' => array(
        'disable_cache' => false,
        'lifetime' => 7200, // 2 hours
        'namespace'  => 'spec_local_',
        'cache_perms' => false,
    ),
    'application' => array(
        'title' => "PHPUGLE"
    )
);
