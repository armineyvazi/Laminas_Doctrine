<?php


namespace Post;

use Post\Service\Factory\PostManagerFactory;

use Post\Service\PostManager;
use Post\Entity\Service\PostModelService;
use Post\Entity\Service\Factory\PostModelServiceFactory;

use Laminas\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Post\Controller\Factory\PostControllerFactory;


return [

    'controllers' => [
        'factories' => [
            Controller\PostController::class => PostControllerFactory::class ,
        ]
    ],
    'service-manager'   =>  [
        'aliases' => [
            'PostManager' => PostManager::class
        ],
        'factories'         =>  [
            PostModelService::class     =>  PostModelServiceFactory::class,
            PostManager::class          =>  PostManagerFactory::class,
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
        'template_map' => [
            'layout'      => __DIR__ . './../view/post/post/index.phtml',
            'index/index' => __DIR__ . './../view/post/post/index.phtml',
        ],
        'template_path_stack' => [
            'application' => __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

];