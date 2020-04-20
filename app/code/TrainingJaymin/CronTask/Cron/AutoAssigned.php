<?php

namespace TrainingJaymin\CronTask\Cron;

use \Psr\Log\LoggerInterface;
use Magento\Catalog\Model\CategoryFactory;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class AutoAssigned
{

    protected $logger;

    protected $_category;

    protected $_collection;

    protected $_productCollectionFactory;


    public function __construct(LoggerInterface $logger, CategoryFactory $categoryFactory,
                                CollectionFactory $collectionFactory,
                                \TrainingJaymin\CronTask\Helper\Data $helperData,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory)
    {

        $this->logger = $logger;
        $this->_category = $categoryFactory;
        $this->_collection = $collectionFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->helperData = $helperData;

    }

    /**

     * Write to system.log

     *

     * @return void

     */

    public function execute() {

        // Do your Stuff

        $this->logger->info('Cron Works');

        //$categoryIds = array(2,4);//category id
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToSort('entity_id','desc');
        $collection->addCategoryIds();
        //$collection->addFieldToFilter('category_id', "");

        //$collection->setPageSize(3); // fetching only 3 products

        $proIds=[];
        foreach ($collection as $product)
        {
            /*print_r($product->getCategoryIds());
            echo "<br>";*/
            $proCats = $product->getCategoryIds();
            if(!empty($proCats))
            {

                $productId = $product->getId();
                //print_r($productId);
                $catIds= array_push($proIds,$productId);
            }

        }

        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('entity_id', array('nin' => $proIds));
        $collection->addAttributeToSort('entity_id','desc');
        $collection->addCategoryIds();
        $collection->setPageSize(10); // fetching only 3 products
        foreach ($collection as $product)
        {
            //print_r($product->getData());
            echo "<br>";
            $categoryIds = [
                5
            ];
            $categoryLinks = $this->helperData->getCategoryLink();
            $categoryLinks->assignProductToCategories(
                $product->getSku(),
                $categoryIds
            );
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer); $logger->info('Assigned Succesfully');
            /*$proCats = $product->getCategoryIds();
            $catIds= array_merge($catIds, $proCats);*/
        }









    }

}