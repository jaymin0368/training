<?php

namespace TrainingJaymin\CrudModule\Block;

use Magento\Framework\App\Filesystem\DirectoryList;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_filesystem;
    protected  $_postFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \TrainingJaymin\CrudModule\Model\PostFactory $postFactory
    )
    {
        parent::__construct($context);
        $this->_postFactory = $postFactory;
    }

    public function getResult()
    {
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        return $collection;
    }
}
