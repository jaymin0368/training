<?php
namespace TrainingJaymin\IpRestriction\Model\ResourceModel\CustomIpAddress;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'trainingjaymin_iprestriction_customipaddress_collection';
    protected $_eventObject = 'customipaddress_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrainingJaymin\IpRestriction\Model\CustomIpAddress',
            'TrainingJaymin\IpRestriction\Model\ResourceModel\CustomIpAddress');
    }

}
?>