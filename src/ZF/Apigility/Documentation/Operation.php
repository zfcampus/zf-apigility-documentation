<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\Stdlib\JsonSerializable;

class Operation implements JsonSerializable
{
    /**
     * @var string
     */
    protected $httpMethod;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $requestDescription = '';

    /**
     * @var string
     */
    protected $responseDescription = '';

    /**
     * @param string $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
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
     * @param string $requestDescription
     */
    public function setRequestDescription($requestDescription)
    {
        $this->requestDescription = $requestDescription;
    }

    /**
     * @return string
     */
    public function getRequestDescription()
    {
        return $this->requestDescription;
    }

    /**
     * @param string $responseDescription
     */
    public function setResponseDescription($responseDescription)
    {
        $this->responseDescription = $responseDescription;
    }

    /**
     * @return string
     */
    public function getResponseDescription()
    {
        return $this->responseDescription;
    }

    /**
     * Implement JsonSerializable
     * 
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            'description' => $this->description,
            'request' => $this->requestDescription,
            'response' => $this->responseDescription,
        );
    }
}
