<?php

namespace ZF\Apigility\Documentation;

class Service implements \JsonSerializable
{
    protected $type;
    protected $name;
    protected $route;

    protected $contentNegotiator;
    protected $acceptWhitelist;
    protected $contentTypeWhitelist;

    protected $resourceHttpMethods;
    protected $collectionHttpMethods;

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
    public function setAcceptWhitelist($acceptWhitelist)
    {
        $this->acceptWhitelist = $acceptWhitelist;
    }

    /**
     * @return mixed
     */
    public function getAcceptWhitelist()
    {
        return $this->acceptWhitelist;
    }

    /**
     * @param mixed $contentTypeWhitelist
     */
    public function setContentTypeWhitelist($contentTypeWhitelist)
    {
        $this->contentTypeWhitelist = $contentTypeWhitelist;
    }

    /**
     * @return mixed
     */
    public function getContentTypeWhitelist()
    {
        return $this->contentTypeWhitelist;
    }

    /**
     * @param mixed $resourceHttpMethods
     */
    public function setResourceHttpMethods($resourceHttpMethods)
    {
        $this->resourceHttpMethods = $resourceHttpMethods;
    }

    /**
     * @return mixed
     */
    public function getResourceHttpMethods()
    {
        return $this->resourceHttpMethods;
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
        return array(
            'name' => $this->name,
            'route' => $this->route,
            'resource_http_methods' => $this->resourceHttpMethods,
            'collection_http_methods' => $this->collectionHttpMethods,
            'accept_types' => $this->acceptWhitelist,
            'content_types' => $this->contentTypeWhitelist,
            'fields' => $this->fields,
        );
    }
}
 