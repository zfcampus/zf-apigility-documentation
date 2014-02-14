<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\Stdlib\JsonSerializable;

class Api implements JsonSerializable
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int|string
     */
    protected $version;

    /**
     * @var array
     */
    protected $authorization;

    /**
     * @var array
     */
    protected $services = array();

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
     * @param int|string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return int|string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param array $authorization
     */
    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;
    }

    /**
     * @return array
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * @param Service $service 
     */
    public function addService(Service $service)
    {
        $this->services[] = $service;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Implements JsonSerializable
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            'name'     => $this->name,
            'services' => $this->services,
        );
    }
}
