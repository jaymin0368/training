<?php
namespace TrainingJaymin\IpRestriction\Model\ResourceModel;


class CustomIpAddress extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('custom_ip_addresses', 'post_id');
    }

}