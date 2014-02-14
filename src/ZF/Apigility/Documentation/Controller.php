<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class Controller extends AbstractActionController
{
    /**
     * @var ApiFactory
     */
    protected $apiFactory;

    /**
     * @param ApiFactory $apiFactory
     */
    public function __construct(ApiFactory $apiFactory)
    {
        $this->apiFactory = $apiFactory;
    }

    /**
     * Show/return documentation
     *
     * Returns a ContentNegotiation view model to allow for multiple
     * representations of documentation.
     *
     * @return ViewModel
     */
    public function showAction()
    {
        $apiName = $this->params()->fromRoute('api');
        $apiVersion = $this->params()->fromRoute('version');
        $serviceName = $this->params()->fromRoute('service');

        if ($serviceName) {
            $service = $this->apiFactory->createService($apiName, $apiVersion, $serviceName);
            return new ViewModel($service);
        }

        if ($apiName) {
            $api = $this->apiFactory->createApi($apiName, $apiVersion);
            return new ViewModel($api);
        }

        $apiList = $this->apiFactory->createApiList();
        return new ViewModel(array('apis' => $apiList));
    }
}
