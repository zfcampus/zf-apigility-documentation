<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use ArrayIterator;
use IteratorAggregate;

class Field implements IteratorAggregate
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var null|string
     */
    protected $type = null;

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
     * @param bool $required
     */
    public function setRequired($required)
    {
        $this->required = (bool) $required;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Cast object to array
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'description' => $this->description,
            'required' => $this->required,
            'type' => $this->type,
        );
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
