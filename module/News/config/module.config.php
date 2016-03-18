<?php

namespace News;

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /blog/:controller/:action
            'news' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/news',
                    'defaults' => array(
                        '__NAMESPACE__' => 'News\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'page'          => 1,
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),

                    'paged' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/page/:page',
                            'constraints' => array(
                                'page' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'News\Controller\Index',
                                'action' => 'index',
                            ),
                        ),
                    ),
                ),
            ),

            'display-Post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/news/Posts/:categorySlug/:PostSlug',
                    'constraints' => array(
                        'categorySlug' => '[a-zA-Z0-9-]+',
                        'PostSlug' => '[a-zA-Z0-9-]+',
                    ),
                    'defaults' => array(
                        'controller' => 'News\Controller\Index',
                        'action' => 'viewPost',
                    ),
                ),
            ),

            'edit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/news/edit/:PostId',
                    'constraints' => array(
                        'PostId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'News\Controller\Index',
                        'action' => 'edit',
                    ),
                ),
            ),

            'delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/news/delete/:PostId',
                    'constraints' => array(
                        'PostId' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'News\Controller\Index',
                        'action' => 'delete',
                    ),
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'News\Controller\Index' => Controller\IndexController::class,
            'SamUser\Controller\Dashboard' => 'SamUser\Controller\DashboardController',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'News' => __DIR__ . '/../view',
        ),
    ),
);