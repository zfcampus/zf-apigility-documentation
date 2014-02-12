<?php

namespace ZF\Apigility\Documentation;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllers)
    {
        $services = $controllers->getServiceLocator();
        return new Controller($services->get('ZF\Apigility\Documentation\ApiFactory'));
    }

}
