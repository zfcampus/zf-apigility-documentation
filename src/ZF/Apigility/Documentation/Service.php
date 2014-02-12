<?php

namespace ZF\Apigility\Documentation;

class Service implements \JsonSerializable
{
    protected $type;
    protected $name;
    protected $route;

    protected $contentNegotiator;
    protected $requestAcceptTypes;
    protected $requestContentTypes;

    // Rest properties
    protected $entityHttpMethods;
    protected $collectionHttpMethods;

    // Rpc properties
    protected $httpMethods;

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
     * @param mixed $acceptWhitelist
     */
    public function setRequestAcceptTypes($acceptWhitelist)
    {
        $this->requestAcceptTypes = $acceptWhitelist;
    }

    /**
     * @return mixed
     */
    public function getRequestAcceptTypes()
    {
        return $this->requestAcceptTypes;
    }

    /**
     * @param mixed $contentTypeWhitelist
     */
    public function setRequestContentTypes($contentTypeWhitelist)
    {
        $this->requestContentTypes = $contentTypeWhitelist;
    }

    /**
     * @return mixed
     */
    public function getRequestContentTypes()
    {
        return $this->requestContentTypes;
    }

    /**
     * @param mixed $resourceHttpMethods
     */
    public function setEntityHttpMethods($resourceHttpMethods)
    {
        $this->entityHttpMethods = $resourceHttpMethods;
    }

    /**
     * @return mixed
     */
    public function getEntityHttpMethods()
    {
        return $this->entityHttpMethods;
    }

    /**
     * @param mixed $collectionHttpMethods
     */
    public function setCollectionHttpMethods($collectionHttpMethods)
    {
        $this->collectionHttpMethods = $collectionHttpMethods;
    }

    /**
     * @return mixed
     */
    public function getCollectionHttpMethods()
    {
        return $this->collectionHttpMethods;
    }

    /**
     * @param mixed $httpMethods
     */
    public function setHttpMethods($httpMethods)
    {
        $this->httpMethods = $httpMethods;
    }

    /**
     * @return mixed
     */
    public function getHttpMethods()
    {
        return $this->httpMethods;
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
            'type' => $this->type,
            'route' => $this->route,
            'request_accept_types' => $this->requestAcceptTypes,
            'request_content_types' => $this->requestContentTypes,
            'response_content_types' => $this->requestAcceptTypes,
            'fields' => $this->fields,
        );

        if ($this->type == 'rest') {
            $output['entity_http_methods'] = $this->entityHttpMethods;
            $output['collection_http_methods'] = $this->collectionHttpMethods;
        } else {
            $output['http_methods'] = $this->httpMethods;
        }

        return $output;
    }
}
 