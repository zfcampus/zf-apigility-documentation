<?php

namespace ZFTest\Apigility\Documentation;

use PHPUnit\Framework\TestCase;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\BasePath;
use Zend\View\Helper\ServerUrl;
use Zend\View\Model\ModelInterface;
use ZF\Apigility\Documentation\ApiFactory;
use ZF\Apigility\Documentation\Controller;

class ControllerTest extends TestCase
{
    /**
     * @var MvcEvent
     */
    private $event;

    /**
     * @var ServerUrl
     */
    private $serverUrl;

    /**
     * @var BasePath
     */
    private $basePath;

    /**
     * @var ApiFactory|\PHPUnit_Framework_MockObject_MockObject
     */
    private $apiFactory;

    protected function setUp()
    {
        $this->apiFactory = $this->getMockBuilder(ApiFactory::class)->disableOriginalConstructor()->getMock();
        $this->serverUrl = new ServerUrl();
        $this->basePath = new BasePath();

        $this->event = new MvcEvent();

        if (class_exists('Zend\Router\RouteMatch', true)) {
            $this->event->setRouteMatch(new \Zend\Router\RouteMatch([]));
        } elseif (class_exists('Zend\Mvc\Router\RouteMatch', true)) {
            $this->event->setRouteMatch(new \Zend\Mvc\Router\RouteMatch([]));
        }
    }

    public function testViewModelMissingBasePath()
    {
        $this->serverUrl->setScheme('https');
        $this->serverUrl->setHost('localhost');
        $this->basePath->setBasePath('/controller_test');

        $sut = new Controller($this->apiFactory, $this->serverUrl);
        $sut->setEvent($this->event);

        /** @var ModelInterface $viewModel */
        $viewModel = $sut->showAction();
        self::assertInstanceOf(ModelInterface::class, $viewModel);

        self::assertEquals('https://localhost', $viewModel->getVariable('baseUrl'));
    }

    public function testSetBaseUrlIntoViewModel()
    {
        $this->serverUrl->setScheme('https');
        $this->serverUrl->setHost('localhost');
        $this->basePath->setBasePath('/controller_test');

        $sut = new Controller($this->apiFactory, $this->serverUrl, $this->basePath);
        $sut->setEvent($this->event);

        /** @var ModelInterface $viewModel */
        $viewModel = $sut->showAction();
        self::assertInstanceOf(ModelInterface::class, $viewModel);

        self::assertEquals('https://localhost/controller_test', $viewModel->getVariable('baseUrl'));
    }
}
