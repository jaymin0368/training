<?php
namespace TrainingJaymin\CrudModule\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'POST';


    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    protected function _construct()
    {
        $this->_init('TrainingJaymin\CrudModule\Model\ResourceModel\Post');
    }
}
