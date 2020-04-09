<?php

include('app/bootstrap.php');
use Magento\Framework\App\Bootstrap;
$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();
$stockRegistry = $objectManager->create('Magento\CatalogInventory\Api\StockRegistryInterface');
///echo "asdasd"; die;
print_r($objectManager); die;

$sku = "testproduct1";
$stockItem = $stockRegistry->getStockItemBySku($sku);
$stockItem->setQty($qty);
$stockItem->setIsInStock((bool)$qty);
$stockRegistry->updateStockItemBySku($sku, $stockItem);

