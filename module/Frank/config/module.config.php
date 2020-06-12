<?php
namespace Frank;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\FrankController::class => InvokableFactory::class,
			Controller\PonenteController::class => InvokableFactory::class,
			Controller\OrganizadorController::class => InvokableFactory::class,
			Controller\ActividadController::class => Controller\ControllerFactory::class,
			Controller\EstudianteController::class => InvokableFactory::class,
			Controller\CatalogoController::class => Controller\ControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
			'catalogo' => [
                'type'    => Segment::class,
                'options' => [
					'route' => '/catalogo[/:action][/:id]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					],
                    'defaults' => [
                        'controller' => Controller\CatalogoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
			'actividad' => [
                'type'    => Segment::class,
                'options' => [
					'route' => '/actividad[/:action][/:id]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					],
                    /*'route'    => '/actividad[/:action]',*/
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
            ],
            'frank' => [
                'type'    => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/frank[/:action]',
                    'defaults' => [
                        'controller'    => Controller\FrankController::class,
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
			'estudiante' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/estudiante[/:action]',
                    'defaults' => [
                        'controller' => Controller\EstudianteController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Frank' => __DIR__ . '/../view',
        ],
    ],
];
