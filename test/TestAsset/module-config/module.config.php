<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

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
            'test.rest.foo-bar-collection' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/foo-bar-collection[/:foo_bar_collection_id]',
                    'defaults' => array(
                        'controller' => 'Test\\V1\\Rest\\FooBarCollection\\Controller',
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
            'test.rpc.ping' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ping',
                    'defaults' => array(
                        'controller' => 'Test\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ),
                ),
            ),
            'test.rest.entity-fields' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/entity-fields',
                    'defaults' => array(
                        'controller' => 'Test\\V1\\Rest\\EntityFields\\Controller',
                        'action' => 'test',
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
            3 => 'test.rpc.ping',
            4 => 'test.rest.foo-bar-collection',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'Test\\V1\\Rest\\FooBar\\FooBarResource' => 'Test\\V1\\Rest\\FooBar\\FooBarResource',
            'Test\\V1\\Rest\\FooBarCollection\\FooBarResource' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarResource',
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
        'Test\\V1\\Rest\\FooBarCollection\\Controller' => array(
            'listener' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarResource',
            'route_name' => 'test.rest.foo-bar-collection',
            'route_identifier_name' => 'foo_bar_collectio_id',
            'collection_name' => 'foo_bar_collection',
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
            'entity_class' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarEntity',
            'collection_class' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarCollection',
            'service_name' => 'FooBarCollection',
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
        'Test\\V1\\Rest\\EntityFields\\Controller' => array(
            'listener' => 'Test\\V1\\Rest\\EntityFields\\EntityFieldsResource',
            'route_name' => 'test.rest.entity-fields',
            'route_identifier_name' => 'id',
            'collection_name' => 'entity_fields',
            'entity_http_methods' => array(
                0 => 'PUT',
            ),
            'collection_http_methods' => array(
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\EntityFields\\EntityFieldsEntity',
            'collection_class' => 'Test\\V1\\Rest\\EntityFields\\EntityFieldsCollection',
            'service_name' => 'EntityFields',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Test\\V1\\Rest\\FooBar\\Controller' => 'HalJson',
            'Test\\V1\\Rest\\FooBarCollection\\Controller' => 'HalJson',
            'Test\\V1\\Rest\\BooBaz\\Controller' => 'HalJson',
            'Test\\V1\\Rpc\\MyRpc\\Controller' => 'Json',
            'Test\\V1\\Rpc\\Ping\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Test\\V1\\Rest\\FooBar\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Test\\V1\\Rest\\FooBarCollection\\Controller' => array(
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
            'Test\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Test\\V1\\Rest\\EntityFields\\Controller' => array(
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
            'Test\\V1\\Rest\\FooBarCollection\\Controller' => array(
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
            'Test\\V1\\Rpc\\Ping\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ),
            'Test\\V1\\Rpc\\EntityFields\\Controller' => array(
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
            'Test\\V1\\Rest\\EntityFields\\EntityFieldsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.entity-fields',
                'route_identifier_name' => 'id',
                'is_collection' => true,
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Test\\V1\\Rpc\\MyRpc\\Controller' => 'Test\\V1\\Rpc\\MyRpc\\MyRpcController',
            'Test\\V1\\Rpc\\Ping\\Controller' => 'Test\\V1\\Rpc\\Ping\\PingController',
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
        'Test\\V1\\Rpc\\Ping\\Controller' => array(
            'service_name' => 'Ping',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'test.rpc.ping',
        ),
    ),
    'zf-content-validation' => array(
        'Test\\V1\\Rest\\FooBar\\Controller' => array(
            'input_filter' => 'Test\\V1\\Rest\\FooBar\\Validator',
        ),
        'Test\\V1\\Rest\\FooBarCollection\\Controller' => array(
            'input_filter' => 'Test\\V1\\Rest\\FooBarCollection\\Validator',
        ),
        'Test\\V1\\Rest\\EntityFields\\Controller' => array(
            'input_filter' => 'Test\\V1\\Rest\\EntityFields\\Validator',
            'PUT' => 'Test\\V1\\Rest\\EntityFields\\Validator\\Put',
        ),
    ),
    'input_filter_specs' => array(
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
            'foogoober' => array(
                'type' => 'Zend\InputFilter\InputFilter',
                'subgoober' => array(
                    'name' => 'subgoober',
                    'required' => true,
                    'filters' => array(),
                    'validators' => array(),
                )
            ),
            'foofoogoober' => array(
                'type' => 'Zend\InputFilter\InputFilter',
                'subgoober' => array(
                    'type' => 'Zend\InputFilter\InputFilter',
                    'subgoober' => array(
                        'name' => 'subgoober',
                        'required' => true,
                        'filters' => array(),
                        'validators' => array(),
                    )
                )
            ),
            'companyDetails' => array(
                'type' => 'Zend\\InputFilter\\InputFilter',
                'name' => array(
                    'name' => 'name',
                    'required' => true,
                    'validators' => array(
                    ),
                    'description' => '',
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ),
                'required' => array(
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ),
                'description' => array(
                    'name' => 'website',
                    'required' => false,
                    'validators' => array(
                    ),
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ),
            ),
        ),
        'Test\\V1\\Rest\\FooBarCollection\\Validator' => array(
            'FooBarCollection' => array(
                'type' => Zend\InputFilter\CollectionInputFilter::class,
                'required' => true,
                'count' => 1,
                'input_filter' => array(
                    'type' => Zend\InputFilter\InputFilter::class,
                    'name' => 'FooBar',
                    'required' => true,
                    'filters' => array(),
                    'validators' => array(),
                ),
            ),
            'AnotherCollection' => array(
                'type' => 'Zend\\InputFilter\\CollectionInputFilter',
                'required' => true,
                'count' => 1,
                'input_filter' => array(
                    'type' => Zend\InputFilter\InputFilter::class,
                    'name' => 'FooBar',
                    'required' => true,
                    'filters' => array(),
                    'validators' => array(),
                ),
            ),
        ),
        'Test\\V1\\Rest\\EntityFields\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'test',
                'description' => 'test',
            ),
        ),
        'Test\\V1\\Rest\\EntityFields\\Validator\\Put' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'test_put',
                'description' => 'test_put',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authentication' => array(
            'http' => array(
                'realm' => 'api',
                'htpasswd' => __DIR__ . '/htpasswd',
            ),
        ),
        'authorization' => array(
            'Test\V1\Rest\FooBar\Controller' => array(
                'entity' => array(
                    'DELETE' => true,
                    'GET'    => false,
                    'PATCH'  => true,
                    'POST'   => false,
                    'PUT'    => true,
                ),
                'collection' => array(
                    'DELETE' => false,
                    'GET'    => false,
                    'PATCH'  => false,
                    'POST'   => true,
                    'PUT'    => false,
                ),
            ),
            'Test\V1\Rest\FooBarCollection\Controller' => array(
                'entity' => array(
                    'DELETE' => true,
                    'GET'    => false,
                    'PATCH'  => true,
                    'POST'   => false,
                    'PUT'    => true,
                ),
                'collection' => array(
                    'DELETE' => false,
                    'GET'    => false,
                    'PATCH'  => false,
                    'POST'   => true,
                    'PUT'    => false,
                ),
            ),
            'Test\V1\Rest\BooBaz\Controller' => array(
                'entity' => array(
                    'DELETE' => true,
                    'GET'    => false,
                    'PATCH'  => true,
                    'POST'   => false,
                    'PUT'    => true,
                ),
                'collection' => array(
                    'DELETE' => false,
                    'GET'    => false,
                    'PATCH'  => false,
                    'POST'   => false,
                    'PUT'    => false,
                ),
            ),
            'Test\V1\Rpc\MyRpc\Controller' => array(
                'actions' => array(
                    'myRpc' => array(
                        'DELETE' => false,
                        'GET'    => true,
                        'PATCH'  => false,
                        'POST'   => false,
                        'PUT'    => false,
                    ),
                ),
            ),
            'Test\V1\Rpc\Ping\Controller' => array(
                'actions' => array(
                    'ping' => array(
                        'DELETE' => false,
                        'GET'    => false,
                        'PATCH'  => false,
                        'POST'   => false,
                        'PUT'    => false,
                    ),
                ),
            ),
        ),
    ),
);
