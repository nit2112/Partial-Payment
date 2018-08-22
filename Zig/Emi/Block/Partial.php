<?php

namespace Zig\Emi\Block;

class Partial extends \Magento\Framework\View\Element\Template
	{
		protected $_helper;
		protected $_logger;

		public function __construct(
		    \Magento\Framework\View\Element\Template\Context $context,
		    \Zig\Emi\Helper\Data $helper,
		    \Psr\Log\LoggerInterface $logger,
		    array $data = []
		) {
		    parent::__construct($context, $data);
		     $this->_helper = $helper;
		     $this->_logger = $logger;
		}


		public function getEnable(){
        	return $this->_helper->getEnable();
		    }

		public function getPlan(){
			    // die($this->_helper->getPlan());
		        return $this->_helper->getPlan();
		    }

		public function getPayment(){
			    // var_dump($this->_helper->getPayment());
		        return $this->_helper->getPayment();
		    }

        public function getOrder() {
		 $ObjectManager =   \Magento\Framework\App\ObjectManager::getInstance();
		 $cartData = $ObjectManager->create('Magento\Checkout\Model\Cart')->getQuote();
		 $total = $cartData->getGrandTotal();
   		//

		
		// get cart items
		return $total;
		

	}

		}

?>

