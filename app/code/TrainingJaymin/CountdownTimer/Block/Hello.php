<?php


namespace TrainingJaymin\CountdownTimer\Block;


use Magento\Framework\View\Element\Template;

class Hello extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Product
     */
    private $product;

    public function __construct(Template\Context $context,
                                \Magento\Framework\Registry $registry,
                                array $data = [])
    {
        $this->registry = $registry;
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

    private function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');

            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }

        return $this->product;
    }

    public function getDealAvailable()
    {
        //return $this->getProduct()->getName();
        $brand = $this->getProduct()->getResource()->getAttribute('deal_available')->getFrontend()->getValue($this->product);
        if ($brand != ''){
            echo $brand;
        }


    }

    public function getDealStatus()
    {
        //return $this->getProduct()->getName();
        $brand = $this->getProduct()->getResource()->getAttribute('deal_status')->getFrontend()->getValue($this->product);
        if ($brand != '')
        {
            $deal_available = $this->getDealAvailable();
            echo $deal_available;
        }


    }
}