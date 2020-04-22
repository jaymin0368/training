<?php
namespace TrainingJaymin\OrderProcessingFee\Observer;

use Magento\Framework\Event\ObserverInterface;

class SalesOrderPlaceAfter implements ObserverInterface
{
    protected $helperData;

    public function __construct(\TrainingJaymin\OrderProcessingFee\Helper\Data $helperData)
    {
        $this->helperData = $helperData;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();
//            $orderId = $order->getId();


            $quote = $observer->getQuote();

            $percent = $this->helperData->getGeneralConfig('display_text');

            $balance = ($quote->getSubtotal() * $percent) / 100;

            $order->setFee($balance);
            $order->save();

            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info($balance."OrderId");
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
    }
}
?>