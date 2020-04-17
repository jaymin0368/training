<?php
namespace TrainingJaymin\CrudModule\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('post', 'post_id');   //here "vky_test" is table name and "test_id" is the primary key of custom table
    }
}