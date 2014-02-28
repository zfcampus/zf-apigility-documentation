<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation\View;

use Zend\View\Helper\AbstractHelper;
use ZF\Apigility\Documentation\Service;

class AgAcceptHeaders extends AbstractHelper
{
    /**
     * Render a list group of Accept headers composed by the service
     *
     * @param  Service $service
     * @return string
     */
    public function __invoke(Service $service)
    {
        $view = $this->getView();
        $types = array_map(function ($type) use ($view) {
            return sprintf('<div class="list-group-item">%s</div>', $view->escapeHtml($type));
        }, $service->getRequestAcceptTypes());
        return implode("\n", $types);
    }
}
