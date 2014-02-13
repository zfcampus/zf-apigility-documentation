<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

class Operation implements \JsonSerializable
{
    protected $httpMethod;
    protected $description;
    protected $requestDescription = '';
    protected $responseDescription = '';

    /**
     * @param mixed $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * @return mixed
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
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

    public function jsonSerialize()
    {
        return array(
            'description' => $this->description,
            'request' => $this->requestDescription,
            'response' => $this->responseDescription
        );
    }
}
 