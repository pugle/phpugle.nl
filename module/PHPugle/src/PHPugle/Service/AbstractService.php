<?php
/**
 * @author benwillems
 * @date 25-03-15
 * @namespace PHPugle\Service;
 */

namespace PHPugle\Service;

use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceManager;


class AbstractService {

    /**
     * The Zend Service Manager for easy access to other services
     *
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $servicemanager;

    /**
     * The constructor set the database adapter and servicemanager for global usage
     *
     * @param Adapter $dbAdapter
     * @param ServiceManager $sm
     */
    public function __construct(ServiceManager $sm) {
        $this->servicemanager = $sm;
    }

    /**
     * Return the servicemanager
     */
    public function getServiceLocator() {
        return $this->servicemanager;
    }
}