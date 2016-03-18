<?php
/**
 * Created by PhpStorm.
 * User: free
 * Date: 3/16/2016
 * Time: 7:02 PM
 */

namespace SamUser;
class Module {
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}