<?php
namespace Zig\Emi\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('partial_payment')) {
			
			$table = $installer->getConnection()->newTable(
				$installer->getTable('partial_payment')
			)
			->addColumn(
					'partial_payment_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'partial payment id'
				)
				->addColumn(
					'order_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					30,
					['nullable' => false],
					'order id'
				)
				->addColumn(
					'customer_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					11,
					[
						'nullable' => false
					],
					'customer id'
				)
				->addColumn(
					'customer_first_name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[
						'nullable' => false,
					],
					'First Name'
				)
				->addColumn(
					'customer_last_name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[
						'nullable' => false,
					],
					'Last Name'
				)
				->addColumn(
					'customer_email',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[
						'nullable' => false,
					],
					'Customer Email'
				)
				->addColumn(
					'total_amount',
					\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					[12,4],
					[
						'nullable' => false,
					],
					'Total Amount'
				)
				->addColumn(
					'paid_amount',
					\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					[12,4],
					[
						'nullable' => false
					],
					'Paid Amount'
				)
				->addColumn(
					'remaining_amount',
					\Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					[12,4],
					[
						'nullable' => false,
					],
					'Remaining Amount'
				)
				->addColumn(
					'total_installment',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					2,
					[
						'nullable' => false,
						'unsigned' => true,
					],
					'Total Installment'
				)
				->addColumn(
					'paid_installment',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					2,
					[
						'nullable' => false,
						'unsigned' => true,
					],
					'Paid installment'
				)
				->addColumn(
					'remaining_installment',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					2,
					[
						'nullable' => false,
						'unsigned' => true,
					],
					'Remaining installment'
				)
				->addColumn(
					'partial_payment_status',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					20,
					[
						'nullable' => false,
						'default' => 'Processing'
					],
					'Partial Payment Status'
				)
				->addColumn(
					'order_currency_code',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					5,
					[
						'nullable' => false,
					],
					'Order Currency Code'
				)
				->addColumn(
						'created_at',
						\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
						null,
						['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
						'Created At'
				)->addColumn(
					'updated_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
					'Updated At')
				->setComment('Partial Payment');
			$installer->getConnection()->createTable($table);


		/**
         * Create table 'partial_payment_installment'
         */


			$table = $installer->getConnection()->newTable(
	            $installer->getTable('partial_payment_installment')
	        	)
				->addColumn(
					  'installment_id',
					  \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					  11,
					  [
					  	'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,					  	
					  ],
					  'Installment Id'
					)
					->addColumn(
					'installment_order_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					30,
					['nullable' => false],
					'Installment order id'
					)
					->addColumn(
						'installment_amount',
					  \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
					  [12,4],
					  	[
					  	'nullable' => false,	
					  	],
					  	'Installment Amount'
					)
					->addColumn(
						'installment_due_date',
					  \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					  null,
					  [
					  	'nullable' => false,	
					  ],
					  'Installment Due Date'
					)
					->addColumn(
					 'installment_paid_date',
					  \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					  null,
					  [
					  	'nullable' => false,	
					  ],
					  'Installed Paid Date'
					)
					->addColumn(
						'installment_status',
					  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					  20,
					  [
					  	'nullable' => false,
					  	'default' => 'Remaining',
					  ],
					  'Installed Status'
					)
					->addColumn(
						'payment_method',
					  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					  250,
					  [
					  	'default' => null
					  ],
					  'Payment Method'
					)
					->addColumn(
						'txn_id',
					  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					  100,
					  [
					  	'default' => null
					  ],
					  'TXN Id'
					)
					->addColumn(
						'installment_reminder_email',
					  \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					  1,
					  [
					  	'nullable' => false
					  ],
					  'Reminder Email'
					)
					->setComment('Installment');
			$installer->getConnection()->createTable($table);

			// $installer->getConnection()->addIndex(
			// 	$installer->getTable('mageplaza_helloworld_post'),
			// 	$setup->getIdxName(
			// 		$installer->getTable('mageplaza_helloworld_post'),
			// 		['name','url_key','post_content','tags','featured_image'],
			// 		\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			// 	),
			// 	['name','url_key','post_content','tags','featured_image'],
			// 	\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			// );
		}
		$installer->endSetup();
	}
}

