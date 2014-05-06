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
            case 'apiList':
                return $this->variables['apis'];
            case 'api':
            case 'service':
                return $this->variables['documentation']->toArray();
        }
    }
}
