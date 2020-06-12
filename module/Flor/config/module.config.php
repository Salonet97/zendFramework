<?php
namespace Flor;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\FlorController::class => InvokableFactory::class,
            Controller\CategoriaController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [


            
            'categoria' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/categoria[/:action][:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    /*'route'    => '/categoria[/:action]',*/
                    'defaults' => [
                        'controller' => Controller\CategoriaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            'Flor' => [
                'type'    => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/Flor[/:action]',
                    'defaults' => [
                        'controller'    => Controller\FlorController::class,
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],            
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Flor' => __DIR__ . '/../view',
        ],
    ],
];
