<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\JsonModel;

class Controller extends AbstractActionController
{
    protected $apiFactory;

    public function __construct(ApiFactory $apiFactory)
    {
        $this->apiFactory = $apiFactory;
    }

    public function showAction()
    {
        $apiName = $this->params()->fromRoute('api');
        $apiVersion = $this->params()->fromRoute('version');
        $serviceName = $this->params()->fromRoute('service');

        if ($serviceName) {
            $service = $this->apiFactory->createService($apiName, $apiVersion, $serviceName);
            return new JsonModel($service);
        }

        if ($apiName) {
            $api = $this->apiFactory->createApi($apiName, $apiVersion);
            return new JsonModel(array('api' => $api));
        }

        $apiList = $this->apiFactory->createApiList();
        return new JsonModel(array('apis' => $apiList));
    }
}
