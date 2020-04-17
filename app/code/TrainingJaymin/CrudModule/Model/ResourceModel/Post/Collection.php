<?php
namespace TrainingJaymin\CrudModule\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrainingJaymin\CrudModule\Model\Post',
            'TrainingJaymin\CrudModule\Model\ResourceModel\Post');
    }
}
