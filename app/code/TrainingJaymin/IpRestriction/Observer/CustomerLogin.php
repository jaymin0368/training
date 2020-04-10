<?php

namespace TrainingJaymin\IpRestriction\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use TrainingJaymin\IpRestriction\Model\CustomIpAddressFactory;
use Magento\Framework\Exception\LocalizedException;

use Magento\Framework\UrlInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Response\RedirectInterface;

class CustomerLogin implements ObserverInterface
{
    public $remoteAddress;

    /**
     * @var TrainingJaymin\IpRestriction\Model\CustomIpAddressFactory;
     */
    protected $customIpAddressFactory;

    /**
     * @param CustomIpAddressFactory $customIpAddressFactory
     */

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    protected $_objectManager;

    /**
     * @param  \Magento\Framework\App\ResponseFactory $responseFactory
     */
    protected $_responseFactory;


    /**
     * @param \Magento\Framework\UrlInterface $url
     */
    protected $_url;

    /*
     * @param \Magento\Framework\App\ResponseInterface $response
     */
    protected $_response;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlInterface;


    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;


    public function __construct(RemoteAddress $remoteAddress,
                                CustomIpAddressFactory $customIpAddressFactory,
                                \Magento\Framework\ObjectManagerInterface $objectManager,
                                \Magento\Framework\App\ResponseFactory $responseFactory,
                                \Magento\Framework\App\ResponseInterface $response,
                                UrlInterface $urlInterface,
                                RedirectInterface $redirect,
                                \Psr\Log\LoggerInterface $logger,
                                \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->remoteAddress = $remoteAddress;
        $this->customIpAddressFactory = $customIpAddressFactory;

        $this->_objectManager = $objectManager;
        $this->_responseFactory = $responseFactory;
        $this->_response = $response;
        $this->_urlInterface=$urlInterface;
        $this->_redirect=$redirect;
        $this->logger = $logger;
        $this->customerSession=$customerSession;

    }
    /**
     * @param Observer $observer
     * @return void
     */

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $ip = $this->remoteAddress->getRemoteAddress();




        $newsModel = $this->customIpAddressFactory->create();

        // Load the item with ID is 1
        //$item = $newsModel->load(1);
        $newsCollection = $newsModel->getCollection();
        $ip_allowed = array();
        foreach ($newsCollection->getData() as $value)
        {
            //print_r($value['ipaddress']);
            array_push($ip_allowed,$value['ipaddress']);
        }
        //print_r($ip_allowed); die;
        if (!in_array($ip, $ip_allowed))
        {
            $customer = $observer->getEvent()->getData('customer');
            $customerGroup = $customer->getGroupId();
            $customerId= $this->customerSession->getCustomer()->getId();
            $url = $this->_urlInterface->getUrl('customer/account/login');

            if($customerId) {
                $this->customerSession->destroy();
                throw new LocalizedException(__('The customer group from this ip is not allowed.'));
                //$this->_responseFactory->create()->setRedirect($url)->sendResponse();

            }
        }

        //die(var_dump($item->getData()));
        //var_dump($item->getData());

        // Get news collection

        // Load all data of collection
        //var_dump($newsCollection->getData());


        /*$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info(print_r($item->getData()));*/

    }
}