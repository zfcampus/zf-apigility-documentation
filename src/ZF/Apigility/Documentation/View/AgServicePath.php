<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation\View;

use Zend\View\Helper\AbstractHelper;
use ZF\Apigility\Documentation\Operation;
use ZF\Apigility\Documentation\Service;

class AgServicePath extends AbstractHelper
{
    /**
     * Return the URI path for a given service and operation
     *
     * @param  Service $service
     * @param  Operation $operation
     * @return string
     */
    public function __invoke(Service $service, Operation $operation)
    {
        $route = $service->getRoute();
        $routeIdentifier = $service->getRouteIdentifierName();
        $entityOps = $service->getEntityOperations();
        if (empty($routeIdentifier) || empty($entityOps)) {
            return $route;
        }

        return preg_replace('#\[/?:' . preg_quote($routeIdentifier) . '\]#', '', $route);
    }
}
