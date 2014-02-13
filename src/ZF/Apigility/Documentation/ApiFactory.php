<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\ModuleManager\ModuleManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\Apigility\ApigilityModuleInterface;
use ZF\Apigility\Provider\ApigilityProviderInterface;
use ZF\Configuration\ResourceFactory as ConfigResourceFactory;
use ZF\Configuration\ModuleUtils as ConfigModuleUtils;

class ApiFactory
{
    protected $moduleManager;
    protected $config;
    protected $configModuleUtils;
    protected $docs = array();

    public function __construct(ModuleManager $moduleManager, $config, ConfigModuleUtils $configModuleUtils)
    {
        $this->moduleManager = $moduleManager;
        $this->config = $config;
        $this->configModuleUtils = $configModuleUtils;
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
        return $apigilityModules;
    }

    public function createApi($apiName, $apiVersion)
    {
        $api = new Api;

        $api->setVersion($apiVersion);
        $api->setName($apiName);

        $serviceConfigs = array();
        if ($this->config['zf-rest']) {
            $serviceConfigs = array_merge($serviceConfigs, $this->config['zf-rest']);
        }
        if ($this->config['zf-rpc']) {
            $serviceConfigs = array_merge($serviceConfigs, $this->config['zf-rpc']);
        }

        foreach ($serviceConfigs as $restServiceName => $serviceConfig) {
            if (strpos($restServiceName, $apiName . '\\') === 0) {
                $service = $this->createService($apiName, $apiVersion, $serviceConfig['service_name']);
                $api->addService($service);
            }
        }

        return $api;
    }

    public function createService($apiName, $apiVersion, $serviceName)
    {
        $service = new Service();

        $serviceData = null;

        $apiVersion = (int) $apiVersion;
        if ($apiVersion == 0) {
            $apiVersion = 1;
        }

        foreach ($this->config['zf-rest'] as $serviceClassName => $restConfig) {
            if ((strpos($serviceClassName, $apiName . '\\') === 0)
                && ($restConfig['service_name'] === $serviceName)
                && (strstr($serviceClassName, '\\V' . $apiVersion . '\\') !== false)
            ) {
                $serviceData = $restConfig;
                break;
            }
        }

        if (!$serviceData) {
            foreach ($this->config['zf-rpc'] as $serviceClassName => $rpcConfig) {
                if ((strpos($serviceClassName, $apiName . '\\') === 0)
                    && ($rpcConfig['service_name'] === $serviceName)
                    && (strstr($serviceClassName, '\\V' . $apiVersion . '\\') !== false)
                ) {
                    $serviceData = $rpcConfig;
                    break;
                }
            }
        }

        if (!$serviceData || !isset($serviceClassName)) {
            throw new \InvalidArgumentException('A service by that name could not be found');
        }

        $docsArray = $this->getDocumentationConfig($apiName);

        $service->setName($serviceData['service_name']);
        if (isset($docsArray[$serviceClassName]['description'])) {
            $service->setDescription($docsArray[$serviceClassName]['description']);
        }

        $route = $this->config['router']['routes'][$serviceData['route_name']]['options']['route'];
        $service->setRoute(str_replace('[/v:version]', '', $route)); // remove intenral version prefix, hacky

        $baseOperationData = (isset($serviceData['collection_http_methods']))
            ? $serviceData['collection_http_methods'] : $serviceData['http_methods'];

        $ops = array();
        foreach ($baseOperationData as $httpMethod) {
            $op = new Operation();
            $op->setHttpMethod($httpMethod);
            if (isset($docsArray[$serviceClassName]['collection'][$httpMethod])) {
                $op->setDescription($docsArray[$serviceClassName]['collection'][$httpMethod]['description']);
                $op->setRequestDescription($docsArray[$serviceClassName]['collection'][$httpMethod]['request']);
                $op->setResponseDescription($docsArray[$serviceClassName]['collection'][$httpMethod]['response']);
            }
            $ops[] = $op;
        }
        $service->setOperations($ops);

        if (isset($serviceData['entity_http_methods'])) {
            $ops = array();
            foreach ($serviceData['entity_http_methods'] as $httpMethod) {
                $op = new Operation();
                $op->setHttpMethod($httpMethod);
                if (isset($docsArray[$serviceClassName]['collection'][$httpMethod])) {
                    $op->setDescription($docsArray[$serviceClassName]['collection'][$httpMethod]['description']);
                    $op->setRequestDescription($docsArray[$serviceClassName]['collection'][$httpMethod]['request']);
                    $op->setResponseDescription($docsArray[$serviceClassName]['collection'][$httpMethod]['response']);
                }
                $ops[] = $op;
            }
            $service->setEntityOperations($ops);
        }


        if (isset($this->config['zf-content-validation'][$serviceClassName]['input_filter'])) {
            $validatorName = $this->config['zf-content-validation'][$serviceClassName]['input_filter'];
            $fields = array();
            if (isset($this->config['input_filters'][$validatorName])) {
                foreach ($this->config['input_filters'][$validatorName] as $fieldData) {
                    $fields[] = $field = new Field();
                    $field->setName($fieldData['name']);
                    if (isset($fieldData['description'])) {
                        $field->setDescription($fieldData['description']);
                    }
                    $field->setRequired($fieldData['required']);
                }
                $service->setFields($fields);
            }
        }

        if (isset($this->config['zf-content-negotiation']['accept_whitelist'][$serviceClassName])) {
            $service->setRequestAcceptTypes($this->config['zf-content-negotiation']['accept_whitelist'][$serviceClassName]);
        }

        if (isset($this->config['zf-content-negotiation']['content_type_whitelist'][$serviceClassName])) {
            $service->setRequestContentTypes($this->config['zf-content-negotiation']['content_type_whitelist'][$serviceClassName]);
        }

        return $service;
    }

    protected function getDocumentationConfig($apiName)
    {
        if (!isset($this->docs[$apiName])) {
            $moduleConfigPath = $this->configModuleUtils->getModuleConfigPath($apiName);
            $docConfigPath = dirname($moduleConfigPath) . '/documentation.config.php';
            $this->docs[$apiName] = include $docConfigPath;
        }
        return $this->docs[$apiName];
    }

}
