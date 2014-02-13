<?php
return array(
    'router' => array(
        'routes' => array(
            'test.rest.foo-bar' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/foo-bar[/:foo_bar_id]',
                    'defaults' => array(
                        'controller' => 'Test\\V1\\Rest\\FooBar\\Controller',
                    ),
                ),
            ),
            'test.rest.boo-baz' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/boo-baz[/:boo_baz_id]',
                    'defaults' => array(
                        'controller' => 'Test\\V1\\Rest\\BooBaz\\Controller',
                    ),
                ),
            ),
            'test.rpc.my-rpc' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/my-rpc',
                    'defaults' => array(
                        'controller' => 'Test\\V1\\Rpc\\MyRpc\\Controller',
                        'action' => 'myRpc',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'test.rest.foo-bar',
            1 => 'test.rest.boo-baz',
            2 => 'test.rpc.my-rpc',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'Test\\V1\\Rest\\FooBar\\FooBarResource' => 'Test\\V1\\Rest\\FooBar\\FooBarResource',
            'Test\\V1\\Rest\\BooBaz\\BooBazResource' => 'Test\\V1\\Rest\\BooBaz\\BooBazResource',
        ),
    ),
    'zf-rest' => array(
        'Test\\V1\\Rest\\FooBar\\Controller' => array(
            'listener' => 'Test\\V1\\Rest\\FooBar\\FooBarResource',
            'route_name' => 'test.rest.foo-bar',
            'route_identifier_name' => 'foo_bar_id',
            'collection_name' => 'foo_bar',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\FooBar\\FooBarEntity',
            'collection_class' => 'Test\\V1\\Rest\\FooBar\\FooBarCollection',
            'service_name' => 'FooBar',
        ),
        'Test\\V1\\Rest\\BooBaz\\Controller' => array(
            'listener' => 'Test\\V1\\Rest\\BooBaz\\BooBazResource',
            'route_name' => 'test.rest.boo-baz',
            'route_identifier_name' => 'boo_baz_id',
            'collection_name' => 'boo_baz',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\BooBaz\\BooBazEntity',
            'collection_class' => 'Test\\V1\\Rest\\BooBaz\\BooBazCollection',
            'service_name' => 'BooBaz',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Test\\V1\\Rest\\FooBar\\Controller' => 'HalJson',
            'Test\\V1\\Rest\\BooBaz\\Controller' => 'HalJson',
            'Test\\V1\\Rpc\\MyRpc\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Test\\V1\\Rest\\FooBar\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Test\\V1\\Rest\\BooBaz\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Test\\V1\\Rpc\\MyRpc\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Test\\V1\\Rest\\FooBar\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ),
            'Test\\V1\\Rest\\BooBaz\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ),
            'Test\\V1\\Rpc\\MyRpc\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Test\\V1\\Rest\\FooBar\\FooBarEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.foo-bar',
                'route_identifier_name' => 'foo_bar_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Test\\V1\\Rest\\FooBar\\FooBarCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.foo-bar',
                'route_identifier_name' => 'foo_bar_id',
                'is_collection' => true,
            ),
            'Test\\V1\\Rest\\BooBaz\\BooBazEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.boo-baz',
                'route_identifier_name' => 'boo_baz_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ),
            'Test\\V1\\Rest\\BooBaz\\BooBazCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.boo-baz',
                'route_identifier_name' => 'boo_baz_id',
                'is_collection' => true,
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Test\\V1\\Rpc\\MyRpc\\Controller' => 'Test\\V1\\Rpc\\MyRpc\\MyRpcController',
        ),
    ),
    'zf-rpc' => array(
        'Test\\V1\\Rpc\\MyRpc\\Controller' => array(
            'service_name' => 'MyRpc',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'test.rpc.my-rpc',
        ),
    ),
    'zf-content-validation' => array(
        'Test\\V1\\Rest\\FooBar\\Controller' => array(
            'input_filter' => 'Test\\V1\\Rest\\FooBar\\Validator',
        ),
    ),
    'input_filters' => array(
        'Test\\V1\\Rest\\FooBar\\Validator' => array(
            0 => array(
                'name' => 'goober',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'description' => 'This is the description for goober.',
            ),
            1 => array(
                'name' => 'bergoo',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
    ),
);
