<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use ArrayIterator;
use IteratorAggregate;

class Service implements IteratorAggregate
{
    /**
     * @var Api
     */
    protected $api;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var string
     */
    protected $routeIdentifierName;

    /**
     * @var string
     */
    protected $contentNegotiator;

    /**
     * @var array
     */
    protected $requestAcceptTypes;

    /**
     * @var array
     */
    protected $requestContentTypes;

    /**
     * @var Operation[]
     */
    protected $operations;

    /**
     * @var Operation[]
     */
    protected $entityOperations;

    /**
     * @var Field[]
     */
    protected $fields = array();

    /**
     * @param \ZF\Apigility\Documentation\Api $api
     */
    public function setApi($api)
    {
        $this->api = $api;
    }

    /**
     * @return \ZF\Apigility\Documentation\Api
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $identifierName
     */
    public function setRouteIdentifierName($identifierName)
    {
        $this->routeIdentifierName = $identifierName;
    }

    /**
     * @return string
     */
    public function getRouteIdentifierName()
    {
        return $this->routeIdentifierName;
    }

    /**
     * @param string $contentNegotiator
     */
    public function setContentNegotiator($contentNegotiator)
    {
        $this->contentNegotiator = $contentNegotiator;
    }

    /**
     * @return string
     */
    public function getContentNegotiator()
    {
        return $this->contentNegotiator;
    }

    /**
     * @param array $requestAcceptTypes
     */
    public function setRequestAcceptTypes($requestAcceptTypes)
    {
        $this->requestAcceptTypes = $requestAcceptTypes;
    }

    /**
     * @return array
     */
    public function getRequestAcceptTypes()
    {
        return $this->requestAcceptTypes;
    }

    /**
     * @param array $requestContentTypes
     */
    public function setRequestContentTypes($requestContentTypes)
    {
        $this->requestContentTypes = $requestContentTypes;
    }

    /**
     * @return array
     */
    public function getRequestContentTypes()
    {
        return $this->requestContentTypes;
    }

    /**
     * @param Operation[] $operations
     */
    public function setOperations($operations)
    {
        $this->operations = $operations;
    }

    /**
     * @return Operation[]
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param Operation[] $entityOperations
     */
    public function setEntityOperations($entityOperations)
    {
        $this->entityOperations = $entityOperations;
    }

    /**
     * @return Operation[]
     */
    public function getEntityOperations()
    {
        return $this->entityOperations;
    }

    /**
     * @param array $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getFields($type)
    {
        return isset($this->fields[$type]) ? $this->fields[$type] : array();
    }

    /**
     * Cast object to array
     *
     * @return array
     */
    public function toArray()
    {
        $output = array(
            'name' => $this->name,
            'description' => $this->description,
            'route' => $this->route,
            'route_identifier_name' => $this->routeIdentifierName,
            'request_accept_types' => $this->requestAcceptTypes,
            'request_content_types' => $this->requestContentTypes,
            'response_content_types' => $this->requestAcceptTypes,
        );

        $fields = array();
        if (isset($this->fields['input_filter'])) {
            foreach ($this->fields['input_filter'] as $field) {
                $fields['input_filter'][$field->getName()] = $field->toArray();
            }
        }

        $operations = array();
        foreach ($this->operations as $op) {
            $method = $op->getHttpMethod();

            if (isset($this->fields[$method])) {
                foreach ($this->fields[$method] as $field) {
                    $fields[$method][$field->getName()] = $field->toArray();
                }
            }

            $operations[$method] = $op->toArray();
        }
        $output['fields'] = $fields;
        $output['operations'] = $operations;

        if ($this->entityOperations) {
            $entityOperations = array();
            foreach ($this->entityOperations as $op) {
                $entityOperations[$op->getHttpMethod()] = $op->toArray();
            }
            $output['entity_operations'] = $entityOperations;
        }

        return $output;
    }

    /**
     * Implement IteratorAggregate
     *
     * Passes the return value of toArray() to an ArrayIterator instance
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->toArray());
    }
}
