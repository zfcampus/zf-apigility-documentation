<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014-2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

return [
    'router' => [
        'routes' => [
            'test.rest.foo-bar' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/foo-bar[/:foo_bar_id]',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rest\\FooBar\\Controller',
                    ],
                ],
            ],
            'test.rest.foo-bar-collection' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/foo-bar-collection[/:foo_bar_collection_id]',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rest\\FooBarCollection\\Controller',
                    ],
                ],
            ],
            'test.rest.boo-baz' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/boo-baz[/:boo_baz_id]',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rest\\BooBaz\\Controller',
                    ],
                ],
            ],
            'test.rpc.my-rpc' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/my-rpc',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rpc\\MyRpc\\Controller',
                        'action' => 'myRpc',
                    ],
                ],
            ],
            'test.rpc.ping' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ping',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rpc\\Ping\\Controller',
                        'action' => 'ping',
                    ],
                ],
            ],
            'test.rest.entity-fields' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/entity-fields',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rest\\EntityFields\\Controller',
                        'action' => 'test',
                    ],
                ],
            ],
            'test.rest.bands' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/bands[/:band_id]',
                    'defaults' => [
                        'controller' => 'Test\\V1\\Rest\\Bands\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'test.rest.foo-bar',
            1 => 'test.rest.boo-baz',
            2 => 'test.rpc.my-rpc',
            3 => 'test.rpc.ping',
            4 => 'test.rest.foo-bar-collection',
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'Test\\V1\\Rest\\FooBar\\FooBarResource' => 'Test\\V1\\Rest\\FooBar\\FooBarResource',
            'Test\\V1\\Rest\\FooBarCollection\\FooBarResource' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarResource',
            'Test\\V1\\Rest\\BooBaz\\BooBazResource' => 'Test\\V1\\Rest\\BooBaz\\BooBazResource',
            'Test\\V1\\Rest\\Bands\\BandsResource' => 'Test\\V1\\Rest\\Bands\\BandsResource',
        ],
    ],
    'zf-rest' => [
        'Test\\V1\\Rest\\FooBar\\Controller' => [
            'listener' => 'Test\\V1\\Rest\\FooBar\\FooBarResource',
            'route_name' => 'test.rest.foo-bar',
            'route_identifier_name' => 'foo_bar_id',
            'collection_name' => 'foo_bar',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\FooBar\\FooBarEntity',
            'collection_class' => 'Test\\V1\\Rest\\FooBar\\FooBarCollection',
            'service_name' => 'FooBar',
        ],
        'Test\\V1\\Rest\\FooBarCollection\\Controller' => [
            'listener' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarResource',
            'route_name' => 'test.rest.foo-bar-collection',
            'route_identifier_name' => 'foo_bar_collectio_id',
            'collection_name' => 'foo_bar_collection',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarEntity',
            'collection_class' => 'Test\\V1\\Rest\\FooBarCollection\\FooBarCollection',
            'service_name' => 'FooBarCollection',
        ],
        'Test\\V1\\Rest\\BooBaz\\Controller' => [
            'listener' => 'Test\\V1\\Rest\\BooBaz\\BooBazResource',
            'route_name' => 'test.rest.boo-baz',
            'route_identifier_name' => 'boo_baz_id',
            'collection_name' => 'boo_baz',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\BooBaz\\BooBazEntity',
            'collection_class' => 'Test\\V1\\Rest\\BooBaz\\BooBazCollection',
            'service_name' => 'BooBaz',
        ],
        'Test\\V1\\Rest\\EntityFields\\Controller' => [
            'listener' => 'Test\\V1\\Rest\\EntityFields\\EntityFieldsResource',
            'route_name' => 'test.rest.entity-fields',
            'route_identifier_name' => 'id',
            'collection_name' => 'entity_fields',
            'entity_http_methods' => [
                0 => 'PUT',
            ],
            'collection_http_methods' => [
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\EntityFields\\EntityFieldsEntity',
            'collection_class' => 'Test\\V1\\Rest\\EntityFields\\EntityFieldsCollection',
            'service_name' => 'EntityFields',
        ],
        'Test\\V1\\Rest\\Bands\\Controller' => [
            'listener' => 'Test\\V1\\Rest\\Bands\\BandsResource',
            'route_name' => 'test.rest.bands',
            'route_identifier_name' => 'artist_id',
            'collection_name' => 'foo_bar',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Test\\V1\\Rest\\Bands\\ArtistEntity',
            'collection_class' => 'Test\\V1\\Rest\\Bands\\ArtistCollection',
            'service_name' => 'Bands',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Test\\V1\\Rest\\FooBar\\Controller' => 'HalJson',
            'Test\\V1\\Rest\\FooBarCollection\\Controller' => 'HalJson',
            'Test\\V1\\Rest\\BooBaz\\Controller' => 'HalJson',
            'Test\\V1\\Rpc\\MyRpc\\Controller' => 'Json',
            'Test\\V1\\Rpc\\Ping\\Controller' => 'Json',
            'Test\\V1\\Rest\\Bands\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Test\\V1\\Rest\\FooBar\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Test\\V1\\Rest\\FooBarCollection\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Test\\V1\\Rest\\BooBaz\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Test\\V1\\Rpc\\MyRpc\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Test\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Test\\V1\\Rest\\EntityFields\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
            'Test\\V1\\Rest\\Bands\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Test\\V1\\Rest\\FooBar\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
            'Test\\V1\\Rest\\FooBarCollection\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
            'Test\\V1\\Rest\\BooBaz\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
            'Test\\V1\\Rpc\\MyRpc\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
            'Test\\V1\\Rpc\\Ping\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
            'Test\\V1\\Rpc\\EntityFields\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
            'Test\\V1\\Rest\\Bands\\Controller' => [
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Test\\V1\\Rest\\FooBar\\FooBarEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.foo-bar',
                'route_identifier_name' => 'foo_bar_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ],
            'Test\\V1\\Rest\\FooBar\\FooBarCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.foo-bar',
                'route_identifier_name' => 'foo_bar_id',
                'is_collection' => true,
            ],
            'Test\\V1\\Rest\\BooBaz\\BooBazEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.boo-baz',
                'route_identifier_name' => 'boo_baz_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ],
            'Test\\V1\\Rest\\BooBaz\\BooBazCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.boo-baz',
                'route_identifier_name' => 'boo_baz_id',
                'is_collection' => true,
            ],
            'Test\\V1\\Rest\\EntityFields\\EntityFieldsCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.entity-fields',
                'route_identifier_name' => 'id',
                'is_collection' => true,
            ],
            'Test\\V1\\Rest\\Bands\\ArtistEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.bands',
                'route_identifier_name' => 'artist_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Test\\V1\\Rpc\\MyRpc\\Controller' => 'Test\\V1\\Rpc\\MyRpc\\MyRpcController',
            'Test\\V1\\Rpc\\Ping\\Controller' => 'Test\\V1\\Rpc\\Ping\\PingController',
        ],
    ],
    'zf-rpc' => [
        'Test\\V1\\Rpc\\MyRpc\\Controller' => [
            'service_name' => 'MyRpc',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'test.rpc.my-rpc',
        ],
        'Test\\V1\\Rpc\\Ping\\Controller' => [
            'service_name' => 'Ping',
            'http_methods' => [
                0 => 'GET',
            ],
            'route_name' => 'test.rpc.ping',
        ],
    ],
    'zf-content-validation' => [
        'Test\\V1\\Rest\\FooBar\\Controller' => [
            'input_filter' => 'Test\\V1\\Rest\\FooBar\\Validator',
        ],
        'Test\\V1\\Rest\\FooBarCollection\\Controller' => [
            'input_filter' => 'Test\\V1\\Rest\\FooBarCollection\\Validator',
        ],
        'Test\\V1\\Rest\\EntityFields\\Controller' => [
            'input_filter' => 'Test\\V1\\Rest\\EntityFields\\Validator',
            'PUT' => 'Test\\V1\\Rest\\EntityFields\\Validator\\Put',
        ],
        'Test\\V1\\Rest\\Bands\\Controller' => [
            'input_filter' => 'Test\\V1\\Rest\\Bands\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Test\\V1\\Rest\\FooBar\\Validator' => [
            0 => [
                'name' => 'goober',
                'required' => true,
                'filters' => [],
                'validators' => [],
                'description' => 'This is the description for goober.',
            ],
            1 => [
                'name' => 'bergoo',
                'required' => true,
                'filters' => [],
                'validators' => [],
            ],
            'foogoober' => [
                'type' => 'Zend\InputFilter\InputFilter',
                'subgoober' => [
                    'name' => 'subgoober',
                    'required' => true,
                    'filters' => [],
                    'validators' => [],
                ]
            ],
            'foofoogoober' => [
                'type' => 'Zend\InputFilter\InputFilter',
                'subgoober' => [
                    'type' => 'Zend\InputFilter\InputFilter',
                    'subgoober' => [
                        'name' => 'subgoober',
                        'required' => true,
                        'filters' => [],
                        'validators' => [],
                    ]
                ]
            ],
            'companyDetails' => [
                'type' => 'Zend\\InputFilter\\InputFilter',
                'name' => [
                    'name' => 'name',
                    'required' => true,
                    'validators' => [
                    ],
                    'description' => '',
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ],
                'required' => [
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ],
                'description' => [
                    'name' => 'website',
                    'required' => false,
                    'validators' => [
                    ],
                    'allow_empty' => false,
                    'continue_if_empty' => false,
                ],
            ],
        ],
        'Test\\V1\\Rest\\FooBarCollection\\Validator' => [
            'FooBarCollection' => [
                'type' => Zend\InputFilter\CollectionInputFilter::class,
                'required' => true,
                'count' => 1,
                'input_filter' => [
                    'type' => Zend\InputFilter\InputFilter::class,
                    'name' => 'FooBar',
                    'required' => true,
                    'filters' => [],
                    'validators' => [],
                ],
            ],
            'AnotherCollection' => [
                'type' => 'Zend\\InputFilter\\CollectionInputFilter',
                'required' => true,
                'count' => 1,
                'input_filter' => [
                    'type' => Zend\InputFilter\InputFilter::class,
                    'name' => 'FooBar',
                    'required' => true,
                    'filters' => [],
                    'validators' => [],
                ],
            ],
        ],
        'Test\\V1\\Rest\\EntityFields\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'test',
                'description' => 'test',
            ],
        ],
        'Test\\V1\\Rest\\EntityFields\\Validator\\Put' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'test_put',
                'description' => 'test_put',
            ],
        ],
        'Test\\V1\\Rest\\Bands\\Validator' => [
            [
                'name' => 'name',
                'required' => true,
                'description' => 'The name of the Band.',
            ],
            'artists' => [
                'type' => Zend\InputFilter\CollectionInputFilter::class,
                'input_filter' => [
                    'type' => \Zend\InputFilter\InputFilter::class,
                    'first_name' => [
                        'name' => 'first_name',
                        'required' => true,
                        'description' => 'The Artist\'s first name.',
                    ],
                    'last_name' => [
                        'name' => 'last_name',
                        'required' => true,
                        'description' => 'The Artist\'s last name.',
                    ],
                ],
            ],
            'debut_album' => [
                'type' => \Zend\InputFilter\InputFilter::class,
                'title' => [
                    'name' => 'title',
                    'required' => true,
                    'description' => 'Album title.',
                ],
                'release_date' => [
                    'name' => 'release_date',
                    'required' => true,
                    'description' => 'Album release date.',
                ],
                'tracks' => [
                    'type' => Zend\InputFilter\CollectionInputFilter::class,
                    'input_filter' => [
                        'type' => \Zend\InputFilter\InputFilter::class,
                        'number' => [
                            'name' => 'number',
                            'required' => true,
                            'description' => 'Track number.',
                        ],
                        'title' => [
                            'name' => 'title',
                            'required' => true,
                            'description' => 'Track title.',
                        ],
                    ],
                ],
            ],
            'albums' => [
                'type' => Zend\InputFilter\CollectionInputFilter::class,
                'input_filter' => [
                    'type' => \Zend\InputFilter\InputFilter::class,
                    'title' => [
                        'name' => 'title',
                        'required' => true,
                        'description' => 'Album title.',
                    ],
                    'release_date' => [
                        'name' => 'release_date',
                        'required' => true,
                        'description' => 'Album release date.',
                    ],
                    'tracks' => [
                        'type' => Zend\InputFilter\CollectionInputFilter::class,
                        'input_filter' => [
                            'type' => \Zend\InputFilter\InputFilter::class,
                            'number' => [
                                'name' => 'number',
                                'required' => true,
                                'description' => 'Track number.',
                            ],
                            'title' => [
                                'name' => 'title',
                                'required' => true,
                                'description' => 'Track title.',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'http' => [
                'realm' => 'api',
                'htpasswd' => __DIR__ . '/htpasswd',
            ],
        ],
        'authorization' => [
            'Test\V1\Rest\FooBar\Controller' => [
                'entity' => [
                    'DELETE' => true,
                    'GET'    => false,
                    'PATCH'  => true,
                    'POST'   => false,
                    'PUT'    => true,
                ],
                'collection' => [
                    'DELETE' => false,
                    'GET'    => false,
                    'PATCH'  => false,
                    'POST'   => true,
                    'PUT'    => false,
                ],
            ],
            'Test\V1\Rest\FooBarCollection\Controller' => [
                'entity' => [
                    'DELETE' => true,
                    'GET'    => false,
                    'PATCH'  => true,
                    'POST'   => false,
                    'PUT'    => true,
                ],
                'collection' => [
                    'DELETE' => false,
                    'GET'    => false,
                    'PATCH'  => false,
                    'POST'   => true,
                    'PUT'    => false,
                ],
            ],
            'Test\V1\Rest\BooBaz\Controller' => [
                'entity' => [
                    'DELETE' => true,
                    'GET'    => false,
                    'PATCH'  => true,
                    'POST'   => false,
                    'PUT'    => true,
                ],
                'collection' => [
                    'DELETE' => false,
                    'GET'    => false,
                    'PATCH'  => false,
                    'POST'   => false,
                    'PUT'    => false,
                ],
            ],
            'Test\V1\Rpc\MyRpc\Controller' => [
                'actions' => [
                    'myRpc' => [
                        'DELETE' => false,
                        'GET'    => true,
                        'PATCH'  => false,
                        'POST'   => false,
                        'PUT'    => false,
                    ],
                ],
            ],
            'Test\V1\Rpc\Ping\Controller' => [
                'actions' => [
                    'ping' => [
                        'DELETE' => false,
                        'GET'    => false,
                        'PATCH'  => false,
                        'POST'   => false,
                        'PUT'    => false,
                    ],
                ],
            ],
        ],
    ],
];
