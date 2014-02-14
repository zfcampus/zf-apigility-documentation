<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\Stdlib\JsonSerializable;

class Service implements JsonSerializable
{
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
     * @var array
     */
    protected $fields = array();

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
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Implement JsonSerializable
     * 
     * @return array
     */
    public function jsonSerialize()
    {
        $output = array(
            'name' => $this->name,
            'description' => $this->description,
            'route' => $this->route,
            'request_accept_types' => $this->requestAcceptTypes,
            'request_content_types' => $this->requestContentTypes,
            'response_content_types' => $this->requestAcceptTypes,
        );

        $fields = array();
        foreach ($this->fields as $field) {
            $fields[$field->getName()] = $field->jsonSerialize();
        }
        $output['fields'] = $fields;

        $operations = array();
        foreach ($this->operations as $op) {
            $operations[$op->getHttpMethod()] = $op->jsonSerialize();
        }
        $output['operations'] = $operations;

        if ($this->entityOperations) {
            $entityOperations = array();
            foreach ($this->entityOperations as $op) {
                $entityOperations[$op->getHttpMethod()] = $op->jsonSerialize();
            }
            $output['entity_operations'] = $entityOperations;
        }

        return $output;
    }
}
