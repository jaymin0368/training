<?php

namespace TrainingJaymin\IpRestriction\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use TrainingJaymin\IpRestriction\Model\CustomIpAddressFactory;

class Index extends Action
{
    /**
     * @var TrainingJaymin\IpRestriction\Model\CustomIpAddressFactory;
     */
    protected $customIpAddressFactory;

    /**
     * @param Context $context
     * @param CustomIpAddressFactory $customIpAddressFactory
     */

    protected $helperData;

    protected $_productCollectionFactory;


    public function __construct(
        Context $context,
        CustomIpAddressFactory $customIpAddressFactory,
        \TrainingJaymin\IpRestriction\Helper\Data $helperData,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    ) {
        parent::__construct($context);
        $this->helperData = $helperData;
        $this->customIpAddressFactory = $customIpAddressFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
    }

    public function execute()
    {
        /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
        $newsModel = $this->customIpAddressFactory->create();

        // Load the item with ID is 1
        $item = $newsModel->load(1);
        //var_dump($item->getData());

        // Get news collection
        $newsCollection = $newsModel->getCollection();
        // Load all data of collection
        echo '<pre>';
        print_r($newsCollection->getData());
        $ip_allowed = array();
        foreach ($newsCollection->getData() as $value)
        {
            //print_r($value['ipaddress']);
            array_push($ip_allowed,$value['ipaddress']);
        }
        if (!in_array("12.10.21.20", $ip_allowed))
        {
            echo "Didint got Irix";
        }
        print_r($ip_allowed);

        echo $this->helperData->getGeneralConfig('enable');
        echo $this->helperData->getGeneralConfig('display_text');


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
        //print_r($proIds);
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('entity_id', array('nin' => $proIds));
        $collection->addAttributeToSort('entity_id','desc');
        $collection->addCategoryIds();
        $collection->setPageSize(10); // fetching only 3 products
        foreach ($collection as $product)
        {
            print_r($product->getData());
            echo "<br>";
            $categoryIds = [
                5
            ];
            $categoryLinks = $this->helperData->getCategoryLink();
            $categoryLinks->assignProductToCategories(
                $product->getSku(),
                $categoryIds
            );
            /*$proCats = $product->getCategoryIds();
            $catIds= array_merge($catIds, $proCats);*/
        }


    }
}