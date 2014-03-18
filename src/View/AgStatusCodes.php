<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation\View;

use Zend\View\Helper\AbstractHelper;
use ZF\Apigility\Documentation\Operation;

class AgStatusCodes extends AbstractHelper
{
    public function __invoke(Operation $operation)
    {
        $view = $this->getView();
        $statusCodes = array_map(function ($status) use ($view) {
            return sprintf('<li class="list-group-item"><strong>%s:</strong> %s</li>', $view->escapeHtml($status['code']), $view->escapeHtml($status['message']));
        }, $operation->getResponseStatusCodes());

        return sprintf("<ul class=\"list-group\">\n%s\n</ul>\n", implode("\n", $statusCodes));
    }
}
