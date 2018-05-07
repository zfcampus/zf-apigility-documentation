<?php

namespace ZFTest\Apigility\Documentation;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Helper\BasePath;
use Zend\View\Helper\ServerUrl;
use ZF\Apigility\Documentation\ApiFactory;
use ZF\Apigility\Documentation\Controller;
use ZF\Apigility\Documentation\ControllerFactory;

class ControllerFactoryTest extends TestCase
{
    public function testCreateController()
    {
        $apiFactory = $this->getMockBuilder(ApiFactory::class)->disableOriginalConstructor()->getMock();

        $viewHelpers = new ServiceManager();
        $viewHelpers->setService('ServerUrl', new ServerUrl());
        $viewHelpers->setService('BasePath', new BasePath());

        $container = new ServiceManager();
        $container->setService('ViewHelperManager', $viewHelpers);
        $container->setService(
            ApiFactory::class,
            $apiFactory
        );

        $controller = (new ControllerFactory())->createService($container);

        self::assertInstanceOf(Controller::class, $controller);
    }
}
