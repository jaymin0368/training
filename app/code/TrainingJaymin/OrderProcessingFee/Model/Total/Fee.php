<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainingJaymin\OrderProcessingFee\Model\Total;


class Fee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    protected $quoteValidator = null;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Recipient email config path
     */
    const XML_PATH_EMAIL_RECIPIENT = 'helloworld/general/display_text';

    protected $helperData;

    protected $finalamount;

    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \TrainingJaymin\OrderProcessingFee\Helper\Data $helperData)
    {
        $this->quoteValidator = $quoteValidator;
        $this->scopeConfig = $scopeConfig;
        $this->helperData = $helperData;
    }
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);


        $exist_amount = 0; //$quote->getFee();
        $fee = 14; //Excellence_Fee_Model_Fee::getFee();
        $balance = $fee - $exist_amount;
        //echo $quote->getSubtotal(); die;
        $percent = $this->helperData->getGeneralConfig('display_text');

        $is_percent = $this->helperData->getGeneralConfig('enable');
        $balance = 0;
        if($is_percent == 1)
        {
            $balance = ($quote->getSubtotal() * $percent) / 100;
        }

            $total->setTotalAmount('fee', $balance);
            $total->setBaseTotalAmount('fee', $balance);

            $total->setFee($balance);
            $total->setBaseFee($balance);

            //$total->setGrandTotal($total->getGrandTotal() + $balance);
            //$total->setBaseGrandTotal($total->getBaseGrandTotal() + $balance);
            $total->setBaseGrandTotal($quote->getSubtotal() + $balance);

            //print_r($total->getBaseGrandTotal()); die;


            return $this;



    }

    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }
    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array|null
     */
    /**
     * Assign subtotal amount and label to address object
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $percent = $this->helperData->getGeneralConfig('display_text');

        $is_percent = $this->helperData->getGeneralConfig('enable');

        $balance = 0;
        if($is_percent == 1)
        {
            $balance = ($quote->getSubtotal() * $percent) / 100;

        }
            return [
                'code' => 'fee',
                'title' => 'Fee',
                'value' => $balance
            ];


    }

    /**
     * Get Subtotal label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getLabel()
    {
        return __('Fee');
    }

    /*public function setFinalAmount($amount)
    {
        $this->finalamount = $amount;
    }*/

    public function getPercentage()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;

        return $this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope);

    }
}