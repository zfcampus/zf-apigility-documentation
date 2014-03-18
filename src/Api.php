<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use ArrayIterator;
use IteratorAggregate;

//use ZF\ContentNegotiation\ViewModel;

class Api implements IteratorAggregate
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int|string
     */
    protected $version = 1;

    /**
     * @var array
     */
    protected $authorization;

    /**
     * @var Service[]
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
     * Cast object to array
     *
     * @return array
     */
    public function toArray()
    {
        $array = array(
            'name'     => $this->name,
            'version'  => $this->version,
            'services' => array()
        );
        foreach ($this->services as $i => $service) {
            $array['services'][$i] = $service->toArray();
        }
        return $array;
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
