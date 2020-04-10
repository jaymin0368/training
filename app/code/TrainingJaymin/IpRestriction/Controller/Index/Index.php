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
    public function __construct(
        Context $context,
        CustomIpAddressFactory $customIpAddressFactory
    ) {
        parent::__construct($context);
        $this->customIpAddressFactory = $customIpAddressFactory;
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

    }
}