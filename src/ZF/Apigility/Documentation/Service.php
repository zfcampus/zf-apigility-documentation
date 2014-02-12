<?php

namespace ZF\Apigility\Documentation;

class Service implements \JsonSerializable
{
    protected $type;
    protected $name;
    protected $description;
    protected $route;

    protected $contentNegotiator;
    protected $requestAcceptTypes;
    protected $requestContentTypes;

    protected $operations;
    protected $entityOperations;

    protected $fields = array();


    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }


    /**
     * @param mixed $contentNegotiator
     */
    public function setContentNegotiator($contentNegotiator)
    {
        $this->contentNegotiator = $contentNegotiator;
    }

    /**
     * @return mixed
     */
    public function getContentNegotiator()
    {
        return $this->contentNegotiator;
    }

    /**
     * @param mixed $requestAcceptTypes
     */
    public function setRequestAcceptTypes($requestAcceptTypes)
    {
        $this->requestAcceptTypes = $requestAcceptTypes;
    }

    /**
     * @return mixed
     */
    public function getRequestAcceptTypes()
    {
        return $this->requestAcceptTypes;
    }

    /**
     * @param mixed $requestContentTypes
     */
    public function setRequestContentTypes($requestContentTypes)
    {
        $this->requestContentTypes = $requestContentTypes;
    }

    /**
     * @return mixed
     */
    public function getRequestContentTypes()
    {
        return $this->requestContentTypes;
    }

    /**
     * @param mixed $operations
     */
    public function setOperations($operations)
    {
        $this->operations = $operations;
    }

    /**
     * @return mixed
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param mixed $entityOperations
     */
    public function setEntityOperations($entityOperations)
    {
        $this->entityOperations = $entityOperations;
    }

    /**
     * @return mixed
     */
    public function getEntityOperations()
    {
        return $this->entityOperations;
    }



    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    public function jsonSerialize()
    {
        $output = array(
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'route' => $this->route,
            'request_accept_types' => $this->requestAcceptTypes,
            'request_content_types' => $this->requestContentTypes,
            'response_content_types' => $this->requestAcceptTypes,
            'fields' => $this->fields,
        );

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
 