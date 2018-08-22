<?php

namespace Zig\Emi\Block\Order;

use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Payment\Model\Config;


class Installment extends \Magento\Framework\View\Element\Template
{

	protected $remainingAmount;

	protected $block;

    protected $_appConfigScopeConfigInterface;
    /**
     * @var Config
     */
    protected $_paymentModelConfig;

    protected $_currentOrder;

    protected $_connection;

    protected $_logger;

	public function __construct(
			\Magento\Framework\View\Element\Template\Context $context,
			\Magento\Sales\Block\Order\Totals $installment,
			ScopeConfigInterface $appConfigScopeConfigInterface,
            Config $paymentModelConfig,
            \Psr\Log\LoggerInterface $logger,
			array $data = []
		) {
			parent::__construct($context, $data);
			$this->block = $installment;
			$this->_appConfigScopeConfigInterface = $appConfigScopeConfigInterface;
            $this->_paymentModelConfig = $paymentModelConfig;
            $this->_logger = $logger;
	}

	public function getRemaining(){
        $remaining = $this->block->getSource();
        $this->remainingAmount = ($remaining->getGrandTotal()) - ($remaining->getDepositAmount());

        return $this->remainingAmount;
	}

    public function getConnection(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        return $connection;
    }


	public function activePayment()
    {
        $payments = $this->_paymentModelConfig->getActiveMethods();
        $methods = array();
        foreach ($payments as $paymentCode => $paymentModel) {
            $paymentTitle = $this->_appConfigScopeConfigInterface
                ->getValue('payment/'.$paymentCode.'/title');
            $methods[$paymentCode] = array(
                'label' => $paymentTitle,
                'value' => $paymentCode
            );
        }
        $this->getOrderDetail();
        return $methods;
    }


    public function getOrderDetail()
    {
       $order = $this->block->getSource();
        $this->_logger->addDebug(json_encode($order));
     
       return $order;
    }

    public function installmentDetail(){
        $order = $this->getOrderDetail();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('partial_payment'); 

        $sql = "Select remaining_installment FROM " . $tableName." where order_id=".$order->getIncrementId();
        $result = $connection->fetchRow($sql);

        return $result['remaining_installment'];
    }

    public function installmentDueDate(){
        $order = $this->getOrderDetail();
        $connection = $this->getConnection();
        $tableName = 'partial_payment_installment'; 
        $sql = "Select installment_paid_date FROM " . $tableName." where installment_order_id=".$order->getIncrementId();
        $date = $connection->fetchRow($sql);
                // $nextMonth = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
        // return strtotime($date);
        return $date['installment_paid_date'];
    }





}
?>