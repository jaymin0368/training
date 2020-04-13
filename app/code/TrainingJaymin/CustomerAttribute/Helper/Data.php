<?php

namespace TrainingJaymin\CustomerAttribute\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class Data extends AbstractHelper
{

    const XML_PATH_HELLOWORLD = 'helloworld/';

    protected $_customerSession;

    protected $customerRepository;


    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->_customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        parent::__construct($context);
    }

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

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getCustomerId()
    {
        //return current customer ID
        return $this->_customerSession->getId();
    }

    public function getAttributeValue()
    {
        $customerId = $this->getCustomerId();
        $customer = $this->customerRepository->getById($customerId);
        return $customer->getCustomAttribute('mothersname');
    }

}