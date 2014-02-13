<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;


class Api implements \JsonSerializable
{
    protected $name;
    protected $version;
    protected $authorization;

    protected $services = array();

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
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $authorization
     */
    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;
    }

    /**
     * @return mixed
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }


    public function addService(Service $service)
    {
        $this->services[] = $service;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }


    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'services' => $this->services
        ];
    }
}