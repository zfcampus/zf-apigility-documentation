<?php

namespace ZFTest\Apigility\Documentation;


use ZF\Apigility\Documentation\ApiFactory;

class ApiFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ApiFactory */
    protected $apiFactory;

    public function setup()
    {
        $this->apiFactory = new ApiFactory(
            ($moduleManager = $this->getMock('Zend\ModuleManager\ModuleManager', array('getModules', 'getModule'))),
            include __DIR__ . '/TestAsset/module-config/module.config.php',
            ($moduleUtils = $this->getMock('ZF\Configuration\ModuleUtils', array('getModuleConfigPath')))
        );

        $mockModule = $this->getMock('ZF\Apigility\Provider\ApigilityProviderInterface');

        $moduleManager->expects($this->any())->method('getModules')->will($this->returnValue(array('Test')));
        $moduleManager->expects($this->any())->method('getModule')->will($this->returnValue($mockModule));
        $moduleUtils->expects($this->any())->method('getModuleConfigPath')->will($this->returnValue(__DIR__ . '/TestAsset/module-config/module.config.php'));
    }

    public function testCreateApiList()
    {
        $apiList = $this->apiFactory->createApiList();
        $this->assertCount(1, $apiList);
        $this->assertEquals('Test', $apiList[0]);
    }

    public function testCreateApi()
    {
        $api = $this->apiFactory->createApi('Test', 1);
        $this->assertInstanceOf('ZF\Apigility\Documentation\Api', $api);

        $this->assertEquals('Test', $api->getName());
        $this->assertEquals(1, $api->getVersion());
        $this->assertCount(3, $api->getServices());
    }

    public function testCreateService()
    {
        // $moduleConfig = include __DIR__ . '/TestAsset/module-config/module.config.php';
        $docConfig = include __DIR__ . '/TestAsset/module-config/documentation.config.php';

        $service = $this->apiFactory->createService('Test', 1, 'FooBar');
        $this->assertInstanceOf('ZF\Apigility\Documentation\Service', $service);

        $this->assertEquals('FooBar', $service->getName());
        $this->assertEquals($docConfig['Test\V1\Rest\FooBar\Controller']['description'], $service->getDescription());

        $fields = $service->getFields();
        $this->assertCount(2, $fields);
        $this->assertInstanceOf('ZF\Apigility\Documentation\Field', $fields[0]);

        $ops = $service->getOperations();
        $this->assertCount(2, $ops);
        $this->assertInstanceOf('ZF\Apigility\Documentation\Operation', $ops[0]);

        $eOps = $service->getEntityOperations();
        $this->assertCount(4, $eOps);
        $this->assertInstanceOf('ZF\Apigility\Documentation\Operation', $eOps[0]);
    }
}
 