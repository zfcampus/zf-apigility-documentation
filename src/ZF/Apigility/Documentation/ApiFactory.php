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

        //        $moduleConfigPath = $this->moduleUtils->getModuleConfigPath($module);
        //        $docConfigPath = dirname($moduleConfigPath) . '/documentation.config.php';
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

        $serviceConfigs = array();
        if ($this->config['zf-rest']) {
            $serviceConfigs = array_merge($serviceConfigs, $this->config['zf-rest']);
        }
        if ($this->config['zf-rpc']) {
            $serviceConfigs = array_merge($serviceConfigs, $this->config['zf-rpc']);
        }

        foreach ($serviceConfigs as $restServiceName => $restService) {
            if (strpos($restServiceName, $apiName . '\\') === 0) {
                $service = new Service();

                $service->setName($restService['service_name']);
                $route = $this->config['router']['routes'][$restService['route_name']]['options']['route'];
                $service->setRoute($route);

                if (isset($restService['entity_http_methods'])) {
                    $service->setType('rest');
                    $service->setEntityHttpMethods($restService['entity_http_methods']);
                    $service->setCollectionHttpMethods($restService['collection_http_methods']);
                } else {
                    $service->setType('rpc');
                    $service->setHttpMethods($restService['http_methods']);
                }

                if (isset($this->config['zf-content-validation'][$restServiceName]['input_filter'])) {
                    $validatorName = $this->config['zf-content-validation'][$restServiceName]['input_filter'];
                    if (isset($this->config['input_filters'][$validatorName])) {
                        $service->setFields($this->config['input_filters'][$validatorName]);
                    }
                }

                if (isset($this->config['zf-content-negotiation']['accept_whitelist'][$restServiceName])) {
                    $service->setRequestAcceptTypes($this->config['zf-content-negotiation']['accept_whitelist'][$restServiceName]);
                }

                if (isset($this->config['zf-content-negotiation']['content_type_whitelist'][$restServiceName])) {
                    $service->setRequestContentTypes($this->config['zf-content-negotiation']['content_type_whitelist'][$restServiceName]);
                }

                $api->addService($service);
            }
        }

        return $api;
    }

}
