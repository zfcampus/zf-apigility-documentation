<?php
return array(
    'router' => array(
        'routes' => array(
            'zf-apigility-documentation' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/documentation',
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