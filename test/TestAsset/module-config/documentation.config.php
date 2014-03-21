<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

return array(
    'Test\\V1\\Rest\\FooBar\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'description' => 'Collection FooBar GET!',
                'request' => null,
                'response' => '{
   "_links": {
       "self": {
           "href": "/foo-bar"
       },
       "first": {
           "href": "/foo-bar?page={page}"
       },
       "prev": {
           "href": "/foo-bar?page={page}"
       },
       "next": {
           "href": "/foo-bar?page={page}"
       },
       "last": {
           "href": "/foo-bar?page={page}"
       }
   }
   "_embedded": {
       "foo_bar": [
           {
               "_links": {
                   "self": {
                       "href": "/foo-bar[/:foo_bar_id]"
                   }
               }
              "goober": "This is the description for goober.",
              "bergoo": ""
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'description' => 'Some general notes about he FooBar collections',
        ),
        'entity' => array(
            'GET' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PATCH' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'PUT' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'DELETE' => array(
                'description' => null,
                'request' => null,
                'response' => null,
            ),
            'description' => 'Some general notes about he FooBar entities',
        ),
        'description' => 'Some general notes about the FooBar rest service',
    ),
    'Test\\V1\\Rpc\\Ping\\Controller' => array(
        'GET' => array(
            'description' => 'Ping the API to see uptime and network lag',
            'request' => null,
            'response' => '{"ack": 123456789}',
        ),
        'description' => 'Ping the API',
    ),
);
