<?php
namespace Salo;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\SaloController::class => InvokableFactory::class,
            Controller\PonenteController::class => InvokableFactory::class,
            Controller\ParticipanteController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [

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
            'participante' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/participante[/:action]',
                    'defaults' => [
                        'controller' => Controller\ParticipanteController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

 
            'Salo' => [
                'type'    => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/Salo[/:action]',
                    'defaults' => [
                        'controller'    => Controller\SaloController::class,
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
            'Salo' => __DIR__ . '/../view',
        ],
    ],
];
