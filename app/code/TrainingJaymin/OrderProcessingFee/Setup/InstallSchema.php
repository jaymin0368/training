<?php

namespace TrainingJaymin\OrderProcessingFee\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $installer->getConnection()->addColumn(
            $installer->getTable('quote'),
            'fee',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'Custom Fee',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order'),
            'fee',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'Custom Fee',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_grid'),
            'fee',
            [
                'type' => 'text',
                'nullable' => false,
                'comment' => 'Custom Fee',
            ]
        );

        $setup->endSetup();
    }
}