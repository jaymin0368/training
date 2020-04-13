<?php


namespace TrainingJaymin\CustomerAttribute\Block;


use Magento\Framework\View\Element\Template;

class Configval extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Product
     */

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;



    protected $helperData;

    public function __construct(Template\Context $context,
                                \Magento\Framework\Registry $registry,
                                \TrainingJaymin\CustomerAttribute\Helper\Data $helperData,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                array $data = [])
    {
        $this->registry = $registry;
        $this->helperData = $helperData;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getHelloWorld()
    {

        return 'Hi';
    }
    /**
     * @return Product
     */




    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}