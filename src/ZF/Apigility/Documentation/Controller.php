<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class Controller extends AbstractActionController
{
    protected $apiFactory;

    public function __construct(ApiFactory $apiFactory)
    {
        $this->apiFactory = $apiFactory;
    }

    public function showAction()
    {
        $api = $this->apiFactory->createApi('Test', 1);
        $view = new JsonModel();
        $view->setVariable('api', $api);
        return $view;
    }
}
