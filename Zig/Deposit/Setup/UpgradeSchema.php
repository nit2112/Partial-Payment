<?php

namespace Zig\Deposit\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;

use Magento\Framework\Setup\ModuleContextInterface;

use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements  UpgradeSchemaInterface

{

public function upgrade(SchemaSetupInterface $setup,

ModuleContextInterface $context){

$setup->startSetup();

if (version_compare($context->getVersion(), '1.0.1') < 0) {

// Get module table

$tableName = $setup->getTable('sales_order');

// Check if the table already exists

if ($setup->getConnection()->isTableExists($tableName) == true) {

// Declare data

$columns = [

'deposit_amount' => [

		'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
		[12,4],
		'nullable' => false,
		'comment' => 'Deposit Amount',
		],

'base_deposit_amount' => [
	 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
	 [12,4],
	 'nullable' => false,
	 'comment' => 'Base Deposit Amount'
	],

'deposit_amount_invoiced' => [
		'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
		[12,4],
		'nullable' => false,
		'comment' => 'Deposit Amount',
		],

'base_deposit_amount' => [
	 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
	 [12,4],
	 'nullable' => false,
	 'comment' => 'Deposit amount invoiced'
	],

'deposit_amount_refunded' => [
		'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
		[12,4],
		'nullable' => false,
		'comment' => 'deposit_amount_refunded',
		],

'base_deposit_amount_refunded' => [
	 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
	 [12,4],
	 'nullable' => false,
	 'comment' => 'Base deposit amount refunded'
	],
];

        $connection = $setup->getConnection();

		foreach ($columns as $name => $definition) {

		$connection->addColumn($tableName, $name, $definition);

		}

	}

$tableName = $setup->getTable('sales_invoice');

// Check if the table already exists

if ($setup->getConnection()->isTableExists($tableName) == true) {

// Declare data

$columns = [

'deposit_amount' => [

		'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
		'nullable' => false,
		'comment' => 'Deposit Amount',
		],

'base_deposit_amount' => [
	 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
	 'nullable' => false,
	 'comment' => 'Base Deposit Amount'
	],
];

        $connection = $setup->getConnection();

		foreach ($columns as $name => $definition) {

		$connection->addColumn($tableName, $name, $definition);

		}

	}

$tableName = $setup->getTable('quote_address');

// Check if the table already exists

if ($setup->getConnection()->isTableExists($tableName) == true) {

// Declare data

$columns = [

'deposit_amount' => [

		'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
		'nullable' => false,
		'comment' => 'Deposit Amount',
		],

'base_deposit_amount' => [
	 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
	 'nullable' => false,
	 'comment' => 'Base Deposit Amount'
	],
];

        $connection = $setup->getConnection();

		foreach ($columns as $name => $definition) {

		$connection->addColumn($tableName, $name, $definition);

		}

	}


$tableName = $setup->getTable('sales_creditmemo');

// Check if the table already exists

if ($setup->getConnection()->isTableExists($tableName) == true) {

// Declare data

$columns = [

'deposit_amount' => [

		'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
		'nullable' => false,
		'comment' => 'Deposit Amount',
		],

'base_deposit_amount' => [
	 'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
	 'nullable' => false,
	 'comment' => 'Base Deposit Amount'
	],
];

        $connection = $setup->getConnection();

		foreach ($columns as $name => $definition) {

		$connection->addColumn($tableName, $name, $definition);

		}

	}



}

 $setup->endSetup();

}

}

