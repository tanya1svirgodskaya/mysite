<?php

namespace Checkout\DataFields\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $this->addDeliveryDateColumn($setup);
        $installer->endSetup();
    }

    public function addDeliveryDateColumn(SchemaSetupInterface $setup)
    {
      $deliveryDate = [
        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
        'nullable'  => true,
        'default' => NULL,
        'comment' => 'Delivery date'
      ];
      /*$deliveryTime = [
        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIME,
        'nullable'  => true,
        'default' => NULL,
        'comment' => 'Delivery time'
      ];*/
      $setup->getConnection()->addColumn(
        $setup->getTable('sales_order'), 'delivery_date',$deliveryDate);

      /*$setup->getConnection()->addColumn(
            $setup->getTable('sales_order_address'),'delivery_date', $deliveryDate);*/

        /*$setup->getConnection()->addColumn(
            $setup->getTable('sales_order_address'),
            'delivery_time',$deliveryTime
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('quote_address'),
            'delivery_time',$deliveryTime
        );*/

    }
}
