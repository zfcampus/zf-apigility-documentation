<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Documentation;

use Zend\ModuleManager\ModuleManager;
use ZF\Apigility\Provider\ApigilityProviderInterface;
use ZF\Configuration\ModuleUtils as ConfigModuleUtils;

class ApiFactory
{
    /**
     * @var ModuleManager
     */
    protected $moduleManager;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var ConfigModuleUtils
     */
    protected $configModuleUtils;

    /**
     * @var array
     */
    protected $docs = array();

    /**
     * @param ModuleManager $moduleManager
     * @param array $config
     * @param ConfigModuleUtils $configModuleUtils
     */
    public function __construct(ModuleManager $moduleManager, $config, ConfigModuleUtils $configModuleUtils)
    {
        $this->moduleManager = $moduleManager;
        $this->config = $config;
        $this->configModuleUtils = $configModuleUtils;
    }

    /**
     * Create list of available API modules
     *
     * @return array
     */
    public function createApiList()
    {
        $apigilityModules = array();
        $q = preg_quote('\\');
        foreach ($this->moduleManager->getModules() as $moduleName) {
            $module = $this->moduleManager->getModule($moduleName);
            if ($module instanceof ApigilityProviderInterface) {
                $versionRegex = '#' . preg_quote($moduleName) . $q . 'V(?P<version>[^' . $q . ']+)' . $q . '#';
                $versions = array();
                $serviceConfigs = array();
                if ($this->config['zf-rest']) {
                    $serviceConfigs = array_merge($serviceConfigs, $this->config['zf-rest']);
                }
                if ($this->config['zf-rpc']) {
                    $serviceConfigs = array_merge($serviceConfigs, $this->config['zf-rpc']);
                }

                foreach ($serviceConfigs as $serviceName => $serviceConfig) {
                    if (!preg_match($versionRegex, $serviceName, $matches)) {
                        continue;
                    }
                    $version = $matches['version'];
                    if (!in_array($version, $versions)) {
                        $versions[] = $version;
                    }
                }

                $apigilityModules[] = array(
                    'name'     => $moduleName,
                    'versions' => $versions,
                );
            }
        }
        return $apigilityModules;
    }

    /**
     * Create documentation details for a given API module and version
     *
     * @param string $apiName
     * @param int|string $apiVersion
     * @return Api
     */
    public function createApi($apiName, $apiVersion = 1)
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

        foreach ($serviceConfigs as $serviceName => $serviceConfig) {
            if (strpos($serviceName, $apiName . '\\') === 0
                && strpos($serviceName, '\V' . $api->getVersion() . '\\')
                && isset($serviceConfig['service_name'])
            ) {
                $service = $this->createService($api, $serviceConfig['service_name']);
                if ($service) {
                    $api->addService($service);
                }
            }
        }

        return $api;
    }

    /**
     * Create documentation details for a given service in a given version of
     * an API module
     *
     * @param string $apiName
     * @param int|string $apiVersion
     * @param string $serviceName
     * @return Service
     */
    public function createService(Api $api, $serviceName)
    {
        $service = new Service();
        $service->setApi($api);

        $serviceData = null;
        $isRest      = false;
        $isRpc       = false;
        $hasSegments = false;
        $hasFields   = false;

        foreach ($this->config['zf-rest'] as $serviceClassName => $restConfig) {
            if ((strpos($serviceClassName, $api->getName() . '\\') === 0)
                && isset($restConfig['service_name'])
                && ($restConfig['service_name'] === $serviceName)
                && (strstr($serviceClassName, '\\V' . $api->getVersion() . '\\') !== false)
            ) {
                $serviceData = $restConfig;
                $isRest = true;
                $hasSegments = true;
                break;
            }
        }

        if (!$serviceData) {
            foreach ($this->config['zf-rpc'] as $serviceClassName => $rpcConfig) {
                if ((strpos($serviceClassName, $api->getName() . '\\') === 0)
                    && isset($rpcConfig['service_name'])
                    && ($rpcConfig['service_name'] === $serviceName)
                    && (strstr($serviceClassName, '\\V' . $api->getVersion() . '\\') !== false)
                ) {
                    $serviceData = $rpcConfig;
                    $serviceData['action'] = $this->marshalActionFromRouteConfig(
                        $serviceName,
                        $serviceClassName,
                        $rpcConfig
                    );
                    $isRpc = true;
                    break;
                }
            }
        }

        if (!$serviceData || !isset($serviceClassName)) {
            return false;
        }

        $authorizations = $this->getAuthorizations($serviceClassName);

        $docsArray = $this->getDocumentationConfig($api->getName());

        $service->setName($serviceData['service_name']);
        if (isset($docsArray[$serviceClassName]['description'])) {
            $service->setDescription($docsArray[$serviceClassName]['description']);
        }

        $route = $this->config['router']['routes'][$serviceData['route_name']]['options']['route'];
        $service->setRoute(str_replace('[/v:version]', '', $route)); // remove internal version prefix, hacky
        if ($isRpc) {
            $hasSegments = $this->hasOptionalSegments($route);
        }

        if (isset($serviceData['route_identifier_name'])) {
            $service->setRouteIdentifierName($serviceData['route_identifier_name']);
        }

        $fields = array();
        if (isset($this->config['zf-content-validation'][$serviceClassName]['input_filter'])) {
            $validatorName = $this->config['zf-content-validation'][$serviceClassName]['input_filter'];
            if (isset($this->config['input_filter_specs'][$validatorName])) {
                foreach ($this->mapFields($this->config['input_filter_specs'][$validatorName]) as $fieldData) {
                    $fields['input_filter'][] = $this->getField($fieldData);
                }
                $hasFields = true;
            }
        }

        $baseOperationData = (isset($serviceData['collection_http_methods']))
            ? $serviceData['collection_http_methods']
            : $serviceData['http_methods'];

        $ops = array();
        foreach ($baseOperationData as $httpMethod) {
            $op = new Operation();
            $op->setHttpMethod($httpMethod);

            if (isset($this->config['zf-content-validation'][$serviceClassName][$httpMethod])) {
                $validatorName = $this->config['zf-content-validation'][$serviceClassName][$httpMethod];
                if (isset($this->config['input_filter_specs'][$validatorName])) {
                    foreach ($this->config['input_filter_specs'][$validatorName] as $fieldData) {
                        $fields[$httpMethod][] = $field = new Field();
                        $field->setName($fieldData['name']);
                        if (isset($fieldData['description'])) {
                            $field->setDescription($fieldData['description']);
                        }
                        $field->setRequired($fieldData['required']);
                    }
                    $hasFields = true;
                }
            }

            if ($isRest) {
                $description = isset($docsArray[$serviceClassName]['collection'][$httpMethod]['description'])
                    ? $docsArray[$serviceClassName]['collection'][$httpMethod]['description']
                    : '';
                $op->setDescription($description);

                $requestDescription = isset($docsArray[$serviceClassName]['collection'][$httpMethod]['request'])
                    ? $docsArray[$serviceClassName]['collection'][$httpMethod]['request']
                    : '';
                $op->setRequestDescription($requestDescription);

                $responseDescription = isset($docsArray[$serviceClassName]['collection'][$httpMethod]['response'])
                    ? $docsArray[$serviceClassName]['collection'][$httpMethod]['response']
                    : '';

                $op->setResponseDescription($responseDescription);
                $op->setRequiresAuthorization(
                    isset($authorizations['collection'][$httpMethod])
                    ? $authorizations['collection'][$httpMethod]
                    : false
                );

                $op->setResponseStatusCodes($this->getStatusCodes(
                    $httpMethod,
                    false,
                    $hasFields,
                    $op->requiresAuthorization()
                ));
            }

            if ($isRpc) {
                $description = isset($docsArray[$serviceClassName][$httpMethod]['description'])
                    ? $docsArray[$serviceClassName][$httpMethod]['description']
                    : '';
                $op->setDescription($description);

                $requestDescription = isset($docsArray[$serviceClassName][$httpMethod]['request'])
                    ? $docsArray[$serviceClassName][$httpMethod]['request']
                    : '';
                $op->setRequestDescription($requestDescription);

                $responseDescription = isset($docsArray[$serviceClassName][$httpMethod]['response'])
                    ? $docsArray[$serviceClassName][$httpMethod]['response']
                    : '';
                $op->setResponseDescription($responseDescription);

                $op->setRequiresAuthorization(
                    isset($authorizations['actions'][$serviceData['action']][$httpMethod])
                    ? $authorizations['actions'][$serviceData['action']][$httpMethod]
                    : false
                );
                $op->setResponseStatusCodes($this->getStatusCodes(
                    $httpMethod,
                    $hasSegments,
                    $hasFields,
                    $op->requiresAuthorization()
                ));
            }

            $ops[] = $op;
        }

        $service->setFields($fields);
        $service->setOperations($ops);

        if (isset($serviceData['entity_http_methods'])) {
            $ops = array();
            foreach ($serviceData['entity_http_methods'] as $httpMethod) {
                $op = new Operation();
                $op->setHttpMethod($httpMethod);

                $description = isset($docsArray[$serviceClassName]['entity'][$httpMethod]['description'])
                    ? $docsArray[$serviceClassName]['entity'][$httpMethod]['description']
                    : '';
                $op->setDescription($description);

                $requestDescription = isset($docsArray[$serviceClassName]['entity'][$httpMethod]['request'])
                    ? $docsArray[$serviceClassName]['entity'][$httpMethod]['request']
                    : '';
                $op->setRequestDescription($requestDescription);

                $responseDescription = isset($docsArray[$serviceClassName]['entity'][$httpMethod]['response'])
                    ? $docsArray[$serviceClassName]['entity'][$httpMethod]['response']
                    : '';
                $op->setResponseDescription($responseDescription);

                $op->setRequiresAuthorization(
                    isset($authorizations['entity'][$httpMethod])
                    ? $authorizations['entity'][$httpMethod]
                    : false
                );
                $op->setResponseStatusCodes($this->getStatusCodes(
                    $httpMethod,
                    true,
                    $hasFields,
                    $op->requiresAuthorization()
                ));
                $ops[] = $op;
            }
            $service->setEntityOperations($ops);
        }

        if (isset($this->config['zf-content-negotiation']['accept_whitelist'][$serviceClassName])) {
            $service->setRequestAcceptTypes(
                $this->config['zf-content-negotiation']['accept_whitelist'][$serviceClassName]
            );
        }

        if (isset($this->config['zf-content-negotiation']['content_type_whitelist'][$serviceClassName])) {
            $service->setRequestContentTypes(
                $this->config['zf-content-negotiation']['content_type_whitelist'][$serviceClassName]
            );
        }

        return $service;
    }

    /**
     * @param array $fields
     * @param string $prefix To unwind nesting of fields
     * @return array
     */
    private function mapFields(array $fields, $prefix = '')
    {
        if (isset($fields['name'])) {
            /// detect usage of "name" as a field group name
            if (is_array($fields['name']) && isset($fields['name']['name'])) {
                return $this->mapFields($fields['name'], 'name');
            }

            if ($prefix) {
                $fields['name'] = sprintf('%s/%s', $prefix, $fields['name']);
            }
            return array($fields);
        }

        $flatFields = array();

        foreach ($fields as $idx => $field) {
            if (isset($field['type']) && is_subclass_of($field['type'], 'Zend\InputFilter\InputFilterInterface')) {
                $filteredFields = array_diff_key($field, array('type' => 0));
                $fullindex = $prefix ? sprintf('%s/%s', $prefix, $idx) : $idx;
                $flatFields = array_merge($flatFields, $this->mapFields($filteredFields, $fullindex));
                continue;
            }

            $flatFields = array_merge($flatFields, $this->mapFields($field, $prefix));
        }

        return $flatFields;
    }

    /**
     * @param array $fieldData
     * @return Field
     */
    private function getField(array $fieldData)
    {
        $field = new Field();

        $field->setName($fieldData['name']);
        if (isset($fieldData['description'])) {
            $field->setDescription($fieldData['description']);
        }

        if (isset($fieldData['type'])) {
            $field->setType($fieldData['type']);
        }

        $required = isset($fieldData['required']) ? (bool) $fieldData['required'] : false;
        $field->setRequired($required);

        return $field;
    }

    /**
     * Retrieve the documentation for a given API module
     *
     * @param string $apiName
     * @return array
     */
    protected function getDocumentationConfig($apiName)
    {
        if (isset($this->docs[$apiName])) {
            return $this->docs[$apiName];
        }

        $moduleConfigPath = $this->configModuleUtils->getModuleConfigPath($apiName);
        $docConfigPath = dirname($moduleConfigPath) . '/documentation.config.php';
        if (file_exists($docConfigPath)) {
            $this->docs[$apiName] = include $docConfigPath;
        } else {
            $this->docs[$apiName] = array();
        }

        return $this->docs[$apiName];
    }

    /**
     * Retrieve authorization data for the given service
     *
     * @param string $serviceName
     * @return array
     */
    protected function getAuthorizations($serviceName)
    {
        if (! isset($this->config['zf-mvc-auth']['authorization'][$serviceName])) {
            return array();
        }
        return $this->config['zf-mvc-auth']['authorization'][$serviceName];
    }

    /**
     * Determine the RPC action name based on the routing configuration
     *
     * @param string $serviceName
     * @param string $serviceClassName
     * @param array $config
     * @return string
     */
    protected function marshalActionFromRouteConfig($serviceName, $serviceClassName, array $config)
    {
        if (! isset($config['route_name'])) {
            return $serviceName;
        }
        if (! isset($this->config['router']['routes'][$config['route_name']])) {
            return $serviceName;
        }
        $route = $this->config['router']['routes'][$config['route_name']];
        if (! isset($route['options']['defaults']['action'])) {
            return $serviceName;
        }

        return $route['options']['defaults']['action'];
    }

    protected function hasOptionalSegments($route)
    {
        return preg_match('#\[.*?:.+\]#', $route);
    }

    protected function getStatusCodes($httpMethod, $hasOptionalSegments, $hasValidation, $requiresAuthorization)
    {
        $statusCodes = array(
            array('code' => '406', 'message' => 'Not Acceptable'),
            array('code' => '415', 'message' => 'Unsupported Media Type'),
        );

        switch ($httpMethod) {
            case 'GET':
                array_push($statusCodes, array('code' => '200', 'message' => 'OK'));
                if ($hasOptionalSegments) {
                    array_push($statusCodes, array('code' => '404', 'message' => 'Not Found'));
                }
                break;
            case 'DELETE':
                array_push($statusCodes, array('code' => '204', 'message' => 'No Content'));
                if ($hasOptionalSegments) {
                    array_push($statusCodes, array('code' => '404', 'message' => 'Not Found'));
                }
                break;
            case 'POST':
                array_push($statusCodes, array('code' => '201', 'message' => 'Created'));
                if ($hasOptionalSegments) {
                    array_push($statusCodes, array('code' => '404', 'message' => 'Not Found'));
                }
                if ($hasValidation) {
                    array_push($statusCodes, array('code' => '400', 'message' => 'Client Error'));
                    array_push($statusCodes, array('code' => '422', 'message' => 'Unprocessable Entity'));
                }
                break;
            case 'PATCH':
            case 'PUT':
                array_push($statusCodes, array('code' => '200', 'message' => 'OK'));
                if ($hasOptionalSegments) {
                    array_push($statusCodes, array('code' => '404', 'message' => 'Not Found'));
                }
                if ($hasValidation) {
                    array_push($statusCodes, array('code' => '400', 'message' => 'Client Error'));
                    array_push($statusCodes, array('code' => '422', 'message' => 'Unprocessable Entity'));
                }
                break;
        }

        if ($requiresAuthorization) {
            array_push($statusCodes, array('code' => '401', 'message' => 'Unauthorized'));
            array_push($statusCodes, array('code' => '403', 'message' => 'Forbidden'));
        }

        return $statusCodes;
    }
}
