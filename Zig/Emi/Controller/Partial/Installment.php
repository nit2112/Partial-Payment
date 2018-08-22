<?php

namespace Zig\Emi\Controller\Partial;

class Installment extends \Magento\Framework\App\Action\Action 
{
	protected $_context;

	protected $_payment;
	public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Zig\Emi\Model\PartialpaymentFactory $payFactory
		){
			parent::__construct($context);
			$this->context= $context;
			$this->_payment = $payFactory;
	}

	public function execute(){
		 $installmentAmount = $this->getRequest()->getParam('installment');
		 $order_id = $this->getRequest()->getParam('order_id');
		 $order_no = $this->getRequest()->getParam('order_no');



		$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
		$resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
		$connection = $resource->getConnection();
		$tableName = $resource->getTableName('partial_payment'); //gives table name with prefix
		 
		//Select Data from table
		$sql = "Select * FROM " . $tableName." where order_id=".$order_id;
		$result = $connection->fetchRow($sql); // gives associated array, table fields as key in array.
		// $paid_amount='';
		// $total_amount='';
		// $remaining_amount='';

        // die(var_dump($result));
		$paid_amount =  $result["paid_amount"]+$installmentAmount;
		$total_amount= $result["total_amount"];
		$remaining_amount = $result["remaining_amount"]-$installmentAmount;
		$total_installment = $result["total_installment"];
		$paid_installment = $result["paid_installment"]+1;
		$remaining_installment = (int)$result["remaining_installment"];
	
		// die(var_dump($remaining_installment));
		
		$deposit_amount = $paid_amount;

		if($remaining_installment != 0){
			$sql1='';
			if($remaining_installment >1){
				$remaining_installment = $total_installment - $paid_installment;
				$sql1 = "Update " . $tableName . " Set paid_amount=". $paid_amount.",remaining_amount=". $remaining_amount .",paid_installment=".$paid_installment.",remaining_installment=".$remaining_installment.",partial_payment_status='Processing' where order_id =".$order_id;
			
				} else {
					$remaining_installment = $total_installment - $paid_installment;
				$sql1 = "Update " . $tableName . " Set paid_amount=". $paid_amount.",remaining_amount=". $remaining_amount .",paid_installment=".$paid_installment.",remaining_installment=".$remaining_installment.",partial_payment_status='Paid' where order_id =".$order_id;
			
				}
				
				$order_sql = "Update sales_order Set deposit_amount=".$deposit_amount." where increment_id =".$order_id;
				$connection->query($sql1);
				$connection->query($order_sql);
			}

		// //Delete Data from table
		// $sql = "Delete FROM " . $tableName." Where emp_id = 10";
		// $connection->query($sql);
		 
		// //Insert Data into table
		// $sql = "Insert Into " . $tableName . " (emp_id, emp_name, emp_code, emp_salary) Values ('','XYZ','ABD20','50000')";
		// $connection->query($sql);
		 
		//Update Data into table
		


		 // $paid = $order->getPaidAmount();

		 // $data = array('')

		 // die(var_dump($sql1));
	     $path = 'sales/order/view/order_id/'.$order_no;
	    
			$this->_redirect($path);
	}


}