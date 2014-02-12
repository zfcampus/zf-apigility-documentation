<?php
return array(
    'router' => array(
        'routes' => array(
            'zf-apigility-documentation' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/documentation[/:api[-v:version][/:service]]', // [/:api[-v:version][/:service]]
                    'constraints' => array(
                        'api' => '[a-zA-Z][a-zA-Z0-9_]+'
                    ),
                    'defaults' => array(
                        'controller' => 'ZF\Apigility\Documentation\Controller',
                        'action'     => 'show',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'ZF\Apigility\Documentation\Controller' => 'ZF\Apigility\Documentation\ControllerFactory',
        )
    ),
    // 'view_manager' => array(
    //     'template_path_stack' => array(
    //         'zf-apigility-documentation' => __DIR__ . '/../view',
    //     ),
    // ),    
);