<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ServerUrl;
use ZF\ContentNegotiation\ViewModel;

class Controller extends AbstractActionController
{
    /**
     * @var ApiFactory
     */
    protected $apiFactory;

    /**
     * @var ServerUrl
     */
     protected $serverUrlViewHelper;

    /**
     * @param ApiFactory $apiFactory
     */
    public function __construct(ApiFactory $apiFactory, ServerUrl $serverUrlViewHelper)
    {
        $this->apiFactory = $apiFactory;
        $this->serverUrlViewHelper = $serverUrlViewHelper;
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
        $apiVersion = $this->params()->fromRoute('version', '1');
        $serviceName = $this->params()->fromRoute('service');

        $viewModel = new ViewModel();
        $viewModel->setTemplate('zf-apigility-documentation/show');
        $viewModel->setVariable('baseUrl', $this->serverUrlViewHelper->__invoke());

        if (!$apiName) {
            $apiList = $this->apiFactory->createApiList();
            $viewModel->setVariable('apis', $apiList);
            $viewModel->setVariable('type', 'apiList');
            return $viewModel;
        }

        $api = $this->apiFactory->createApi($apiName, $apiVersion);

        if (!$serviceName) {
            $viewModel->setVariable('documentation', $api);
            $viewModel->setVariable('type', 'api');
            return $viewModel;
        }

        $service = $this->apiFactory->createService($api, $serviceName);
        $viewModel->setVariable('documentation', $service);
        $viewModel->setVariable('type', 'service');
        return $viewModel;
    }
}
