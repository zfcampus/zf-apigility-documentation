<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation\Factory;

use Interop\Container\ContainerInterface;
use ZF\Apigility\Documentation\ApiFactory;
use ZF\Configuration\ModuleUtils;

class ApiFactoryFactory
{
    /**
     * @param ContainerInterface $container
     * @return ApiFactory
     */
    public function __invoke(ContainerInterface $container)
    {
        return new ApiFactory(
            $container->get('ModuleManager'),
            $container->get('config'),
            $container->get(ModuleUtils::class)
        );
    }
}
