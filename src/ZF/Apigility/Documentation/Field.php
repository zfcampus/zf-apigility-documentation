<?php

namespace ZF\Apigility\Documentation;

class Field implements \JsonSerializable
{
    protected $name;
    protected $description = '';
    protected $required = false;

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
     * @param mixed $required
     */
    public function setRequired($required)
    {
        $this->required = (bool) $required;
    }

    /**
     * @return mixed
     */
    public function isRequired()
    {
        return $this->required;
    }

    public function jsonSerialize()
    {
        return array(
            'description' => $this->description,
            'required' => $this->required
        );
    }
}
 