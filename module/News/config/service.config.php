<?php

namespace News;

return array(
    'invokables' => array(
        'News\Repository\NewsRepository' => 'News\Repository\NewsRepositoryImpl',
    ),

    'factories' => array(
        'News\Service\NewsService' => function(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
            $NewsService = new \News\Service\NewsServiceImpl();
            $NewsService->setNewsRepository($serviceLocator->get('News\Repository\NewsRepository'));

            return $NewsService;
        },
    ),

    'initializers' => array(
        function($instance, \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
            if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
                $instance->setDbAdapter($serviceLocator->get('Zend\Db\Adapter\Adapter'));
            }
        },
    ),
);