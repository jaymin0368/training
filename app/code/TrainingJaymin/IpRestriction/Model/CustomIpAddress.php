<?php
namespace TrainingJaymin\IpRestriction\Model;
class CustomIpAddress extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'custom_ip_addresses';

    protected $_cacheTag = 'custom_ip_addresses';

    protected $_eventPrefix = 'custom_ip_addresses';

    protected function _construct()
    {
        $this->_init('TrainingJaymin\IpRestriction\Model\ResourceModel\CustomIpAddress');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}