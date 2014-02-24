<?php

namespace ZF\Apigility\Documentation;

use Zend\View\Model\JsonModel as BaseJsonModel;

class JsonModel extends BaseJsonModel
{
    public function terminate()
    {
        return true;
    }

    public function getVariables()
    {
        switch ($this->variables['type']) {
            case 'api-list':
                return $this->variables['documentation'];
            case 'api':
            case 'service':
                return $this->variables['documentation']->toArray();
        }
    }
} 