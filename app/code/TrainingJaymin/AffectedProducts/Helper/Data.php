<?php
namespace TrainingJaymin\AffectedProducts\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{


    /**
     * get products tab Url in admin
     * @return string
     */
    public function getProductsGridUrl()
    {
        return $this->_backendUrl->getUrl('wsproductsgrid/contacts/products', ['_current' => true]);
    }
}
