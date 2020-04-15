<?php

namespace TrainingJaymin\OrderProcessingFee\Controller\Custom;

class Storeconfig extends \Magento\Framework\App\Action\Action
{

    protected $resultJsonFactory;

    protected $storeManager;

    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $response = [];

        $response = [
            'success' => true,
            'value' => 'abcd'
        ];
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }

}
