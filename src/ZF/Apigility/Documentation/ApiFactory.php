<?php

namespace ZF\Apigility\Documentation;

use Zend\ModuleManager\ModuleManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\Apigility\ApigilityModuleInterface;
use ZF\Apigility\Provider\ApigilityProviderInterface;
use ZF\Configuration\ResourceFactory as ConfigResourceFactory;

class ApiFactory
{
    protected $moduleManager;
    protected $config;

    public function __construct(ModuleManager $moduleManager, $config)
    {
        $this->moduleManager = $moduleManager;
        $this->config = $config;
    }

    public function createApiList()
    {
        $apigilityModules = array();
        foreach ($this->moduleManager->getModules() as $moduleName) {
            $module = $this->moduleManager->getModule($moduleName);
            if ($module instanceof ApigilityProviderInterface) {
                $apigilityModules[] = $moduleName;
            }
        }
        var_dump($apigilityModules);
    }

    public function createApi($apiName, $apiVersion)
    {
        $api = new Api;



        // @todo validate $name
        // @todo validate $version

        $api->setVersion($apiVersion);
        $api->setName($apiName);

        foreach ($this->config['zf-rest'] as $restServiceName => $restService) {
            if (strpos($restServiceName, $apiName . '\\') === 0) {
                $service = new Service();
                $service->setType('rest');
                $service->setName($restServiceName);
                $route = $this->config['router']['routes'][$restService['route_name']]['options']['route'];
                $service->setRoute($route);

                $service->setResourceHttpMethods($restService['resource_http_methods']);
                $service->setCollectionHttpMethods($restService['collection_http_methods']);

                if (isset($this->config['zf-content-validation'][$restServiceName]['input_filter'])) {
                    $validatorName = $this->config['zf-content-validation'][$restServiceName]['input_filter'];
                    if (isset($this->config['input_filters'][$validatorName])) {
                        $service->setFields($this->config['input_filters'][$validatorName]);
                    }
                }

                if (isset($this->config['zf-content-negotiation']['accept_whitelist'][$restServiceName])) {
                    $service->setAcceptWhitelist($this->config['zf-content-negotiation']['accept_whitelist'][$restServiceName]);
                }

                if (isset($this->config['zf-content-negotiation']['content_type_whitelist'][$restServiceName])) {
                    $service->setContentTypeWhitelist($this->config['zf-content-negotiation']['content_type_whitelist'][$restServiceName]);
                }

                $api->addService($service);
            }
        }

        return $api;
    }

}
