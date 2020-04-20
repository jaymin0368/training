<?php

namespace TrainingJaymin\CronTask\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const XML_PATH_HELLOWORLD = 'helloworld/';
    protected $categoryLinkManagement;

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function getGeneralConfig($code, $storeId = null)
    {

        return $this->getConfigValue(self::XML_PATH_HELLOWORLD .'general/'. $code, $storeId);
    }

    public function __construct(Context $context,\Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagementInterface)
    {
        parent::__construct($context);
        $this->categoryLinkManagement = $categoryLinkManagementInterface;
    }

    public function getCategoryLink()
    {
        return $this->categoryLinkManagement;
    }


}