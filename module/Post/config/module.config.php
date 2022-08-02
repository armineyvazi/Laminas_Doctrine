<?php


namespace Post;

use Post\Service\PostManager;
use Laminas\Router\Http\Segment;
use Post\Service\Factory\PostMangerFactory;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Post\Controller\Factory\PostControllerFactory;
use Laminas\ServiceManager\Factory\InvokableFactory;


return [

    'controllers' => [
        'factories' => [
            Controller\PostController::class => PostControllerFactory::class ,
        ]
    ],
    'service-manager'=>[
        'factories'=>[
            Service\PostManager::class=>PostMangerFactory::class,
        ]
    ],
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'post' => [
                'type' => Segment::class ,
                'options' => [
                    'route' => '/post[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PostController::class ,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    // ...
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class ,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ],


    'view_manager' => [
        'template_path_stack' => [
            'post' => __DIR__ . '/../view',
        ],
    ],
];