<?php
use Magento\Framework\App\Bootstrap;
include('../app/bootstrap.php');
$bootstrap = Bootstrap::create(BP, $_SERVER);

$_objectManager = $bootstrap->getObjectManager();
$state = $_objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('adminhtml');

//list of products to check

//sku => update quantity
$products = [
    'testproduct1' => 3
];

echo "Starting...\n";

$_zeroQtyProducts = $_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection')->addFieldToFilter('sku', array_keys($products));
$_stockState = $_objectManager->get('\Magento\CatalogInventory\Api\StockStateInterface');
$_stockRegistry = $_objectManager->get('\Magento\CatalogInventory\Api\StockRegistryInterface');

//if any products found
if($_zeroQtyProducts) 
{
    echo sprintf("Found %s product(s) with a qty of 0\n", count($_zeroQtyProducts));

    foreach ($_zeroQtyProducts as $_product) 
    {
        $_stock = $_stockState->getStockQty($_product->getId(), $_product->getStore()->getWebsiteId());
        $_sku = $_product->getSku();

        echo sprintf("## Processing %s ##\n", $_sku);

        //do a double check quantity is 0 and product has been set to update
        if ((int)$_stock == 0 && isset($products[$_sku])) 
        {
            $_stockItem = $_stockRegistry->getStockItem($_product->getId());
            $_stockItem->setData('is_in_stock',1); //set updated data as your requirement
            $_stockItem->setData('qty', $products[$_sku]); //set updated quantity
            $_stockItem->save(); //save stock of item
            $_product->save();
            echo sprintf("Product had 0 qty..updated to: %s\n", $products[$_sku]);
        }

        echo sprintf("## Finished processing %s ##\n", $_sku);
    }

} 
else 
{
    echo sprintf("0 Products found with provided SKU's.\n");
}


exit("Finished.");
//print_r($_zeroQtyProducts); die;
?>