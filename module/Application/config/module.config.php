<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
			/*'actividad' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/actividad[/:action]',
                    'defaults' => [
                        'controller' => Controller\ActividadController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'ponente' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/ponente[/:action]',
                    'defaults' => [
                        'controller' => Controller\PonenteController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'organizador' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/organizador[/:action]',
                    'defaults' => [
                        'controller' => Controller\OrganizadorController::class,
                        'action'     => 'index',
                    ],
                ],
            ],*/
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
			//Controller\PonenteController::class => InvokableFactory::class,
			//Controller\OrganizadorController::class => InvokableFactory::class,
			//Controller\ActividadController::class => InvokableFactory::class,
            //Controller\CategoriaController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
