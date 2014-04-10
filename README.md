ZF Apigility Documentation
==========================

[![Build Status](https://travis-ci.org/zfcampus/zf-apigility-documentation.png)](https://travis-ci.org/zfcampus/zf-apigility-documentation)

Introduction
------------

This ZF2 module can be used with conjunction with Apigility in order to:

- provide an object model of all captured documentation information, including:
  - All APIs available
  - All Services available in each API
  - All Operations available in each API
  - All required/expected Accept and Content-Type request headers, and expected
    Content-Type response header, for each available API Service Operation.
  - All configured fields for each service
- provide a configurable MVC endpoint for returning documentation
  - documentation will be delivered in a serialized JSON structure by default
  - end-users may configure alternate/additional formats via content-negotiation

Installation
------------

Run the following `composer` command:

```console
$ composer require "zfcampus/zf-apigility-documentation:~1.0-dev"
```

Alternately, manually add the following to your `composer.json`, in the `require` section:

```javascript
"require": {
    "zfcampus/zf-apigility-documentation": "~1.0-dev"
}
```

And then run `composer update` to ensure the module is installed.

Finally, add the module name to your project's `config/application.config.php` under the `modules`
key:

```php
return array(
    /* ... */
    'modules' => array(
        /* ... */
        'ZF\Apigility\Documentation',
    ),
    /* ... */
);
```


Configuration
=============

### User Configuration

### System Configuration

```php
'router' => array(
    'routes' => array(
        'zf-apigility' => array(
            'child_routes' => array(
                'documentation' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route'    => '/documentation[/:api[-v:version][/:service]]',
                        'constraints' => array(
                            'api' => '[a-zA-Z][a-zA-Z0-9_]+',
                        ),
                        'defaults' => array(
                            'controller' => 'ZF\Apigility\Documentation\Controller',
                            'action'     => 'show',
                        ),
                    ),
                ),
            ),
        ),
    ),
),
'controllers' => array(
    'factories' => array(
        'ZF\Apigility\Documentation\Controller' => 'ZF\Apigility\Documentation\ControllerFactory',
    ),
),
'zf-content-negotiation' => array(
    'controllers' => array(
        'ZF\Apigility\Documentation\Controller' => 'Documentation',
    ),
    'accept_whitelist' => array(
        'ZF\Apigility\Documentation\Controller' => array(
            0 => 'application/vnd.swagger+json',
            1 => 'application/json',
        ),
    ),
    'selectors' => array(
        'Documentation' => array(
            'ZF\Apigility\Documentation\JsonModel' => array(
                'application/json',
            ),
            'Zend\View\Model\ViewModel' => array(
                'text/html',
                'application/xhtml+xml',
            ),
        ),
    ),
),
'view_helpers' => array(
    'invokables' => array(
        'agacceptheaders'      => 'ZF\Apigility\Documentation\View\AgAcceptHeaders',
        'agcontenttypeheaders' => 'ZF\Apigility\Documentation\View\AgContentTypeHeaders',
        'agservicepath'        => 'ZF\Apigility\Documentation\View\AgServicePath',
        'agstatuscodes'        => 'ZF\Apigility\Documentation\View\AgStatusCodes',
    ),
),
'view_manager' => array(
    'template_path_stack' => array(
        __DIR__ . '/../view',
    ),
),
```

ZF2 Events
==========

### Events

### Listeners

ZF2 Services
============

### View Helpers

#### `ZF\Apigility\Documentation\View\AgAcceptHeaders` (a.k.a `agacceptheaders`)

#### `ZF\Apigility\Documentation\View\AgContentTypeHeaders`  (a.k.a `agcontenttypeheaders`)

#### `ZF\Apigility\Documentation\View\AgServicePath` (a.k.a `agservicepath`)

#### `ZF\Apigility\Documentation\View\AgStatusCodes` (a.k.a `agstatuscodes`)

### Factories

#### `ZF\Apigility\Documentation\ApiFactory`