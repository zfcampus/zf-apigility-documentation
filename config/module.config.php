<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\Model\ViewModel;

return [
    'router' => [
        'routes' => [
            'zf-apigility' => [
                'child_routes' => [
                    'documentation' => [
                        'type' => 'segment',
                        'options' => [
                            'route'    => '/documentation[/:api[-v:version][/:service]]',
                            'constraints' => [
                                'api' => '[a-zA-Z][a-zA-Z0-9_.%]+',
                            ],
                            'defaults' => [
                                'controller' => Controller::class,
                                'action'     => 'show',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            ApiFactory::class => Factory\ApiFactoryFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller::class => ControllerFactory::class,
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            Controller::class => 'Documentation',
        ],
        'accept_whitelist' => [
            Controller::class => [
                0 => 'application/vnd.swagger+json',
                1 => 'application/json',
            ],
        ],
        'selectors' => [
            'Documentation' => [
                ViewModel::class => [
                    'text/html',
                    'application/xhtml+xml',
                ],
                JsonModel::class => [
                    'application/json',
                ],
            ],
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'agacceptheaders'         => View\AgAcceptHeaders::class,
            'agAcceptHeaders'         => View\AgAcceptHeaders::class,
            'agcontenttypeheaders'    => View\AgContentTypeHeaders::class,
            'agContentTypeHeaders'    => View\AgContentTypeHeaders::class,
            'agservicepath'           => View\AgServicePath::class,
            'agServicePath'           => View\AgServicePath::class,
            'agstatuscodes'           => View\AgStatusCodes::class,
            'agStatusCodes'           => View\AgStatusCodes::class,
            'agtransformdescription'  => View\AgTransformDescription::class,
            'agTransformDescription'  => View\AgTransformDescription::class,
        ],
        'factories' => [
            View\AgAcceptHeaders::class        => InvokableFactory::class,
            View\AgContentTypeHeaders::class   => InvokableFactory::class,
            View\AgServicePath::class          => InvokableFactory::class,
            View\AgStatusCodes::class          => InvokableFactory::class,
            View\AgTransformDescription::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
