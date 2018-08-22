<?php

namespace Zig\Emi\Observer;

class ChangeDisplayText implements \Magento\Framework\Event\ObserverInterface
{

	protected $observer_counter = 1;

	protected $logger;
	protected $_helper;
	protected $_zigFactory;
	protected $_insFactory;


	public function __construct(\Psr\Log\LoggerInterface $logger,\Zig\Emi\Helper\Data $helper,
			\Zig\Emi\Model\PartialpaymentFactory $payFactory, \Zig\Emi\Model\InstallmentFactory $insFactory)
	{
	    $this->logger = $logger;
	    $this->_helper= $helper;
		$this->_zigFactory = $payFactory;
		$this->_insFactory = $insFactory;	 
	}

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		// $displayText = $observer->getEvent()->getData('cart');
		// var_dump($displayText) ;//. " - Event </br>";
		// $displayText->setText('Execute event successfully.');
		// // die($displayText);
		// return $this;
		// $date = new Zend_Date($date, 'MM-dd-Y');
		// $calculationHelper = Mage::helper('partialpayment/calculation');
		$order = $observer->getOrder();
		$this->logger->debug('hello sir ji....');
		// $getOrderCurrency = $order->getOrderCurrencyCode();
		// $this->logger->addDebug('cart:'.$order->getQuote());
		// $this->logger->addDebug(json_encode($order->getData()));
		
		if($this->_helper->getEnable()){
			$downPaymentPercent =  $this->_helper->getPayment();

			$order_id = $order->getIncrementId();
			$customer_id = $order->getCustomerId();
			$first_name = $order->getCustomerFirstname();
			$last_name = $order->getCustomerLastname();
			$email = $order->getCustomerEmail();
			$total_amount = $order->getGrandTotal();
			$paid_amount = ($total_amount* $downPaymentPercent)/100; 
			$downPaymentPercent =  $this->_helper->getPayment();
			$this->logger->debug($order_id);
			$remaining_amount = $total_amount - $paid_amount;
			$orderCurrency = $order->getOrderCurrencyCode();

			/* depost in sales/order */
			$order->setDepositAmount($paid_amount);

		    $this->logger->addDebug(json_encode($order));

			// $this->logger->debug($customer_id);
			// $this->logger->debug($first_name);
			// $this->logger->debug($last_name);
			// $this->logger->debug($email);
			// $this->logger->debug($total_amount);

			$data=array('order_id'=>$order_id,'customer_id'=>$customer_id,
						'customer_first_name'=>$first_name,
						'customer_last_name'=>$last_name,'customer_email'=>$email,
						'total_amount'=>$total_amount,'paid_amount'=>$paid_amount,
						'remaining_amount'=>$remaining_amount,'total_installment'=>3,
						'paid_installment'=>1,'remaining_installment'=>2,
						'order_currency_code'=>$orderCurrency
						);
       		$payment = $this->_zigFactory->create();
		    $payment->setData($data)->save();
		    $date = date("Y-m-d");
			$this->logger->debug('nexr');
			$nextMonth = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
			// $this->logger->debug($nextMonth);

		    //installment start
		    $installmentData = array('installment_order_id' =>$order_id,
		    			'installment_amount' => $paid_amount,
		    			'installment_due_date' => $nextMonth,
		    			'installment_paid_date' => date('Y-m-d'),
		    			'installment_status' => 'Remaining',
		    			'payment_method' => 'paymentMethod',
		    			'txn_id' => 'transectionId', 'installment_reminder_email' => 0
		    			);

		    $installment = $this->_insFactory->create();
		    $installment->setData($installmentData)->save();

		    //installment end
            
			$this->logger->debug("not sure..");

			$this->logger->debug("Done");
		}
		
		
	}
}