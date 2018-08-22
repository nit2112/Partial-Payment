<?php /** * @author Amasty Team * @copyright Copyright (c) 2015 Amasty (http://www.amasty.com) * @package Amasty_HelloWorld */ 
namespace Zig\Emi\Helper; 
class Data extends \Magento\Framework\App\Helper\AbstractHelper {
 /** * @var \Magento\Framework\App\Config\ScopeConfigInterfac */ 
     protected $_scopeConfig;
     CONST ENABLE = 'helloworldd/general/active'; 
     CONST PLAN = 'helloworldd/general/plan'; 
     CONST DOWN_PAYMENT = 'helloworldd/general/downpayment'; 

     public function __construct(
              \Magento\Framework\App\Helper\Context $context, 
              \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig 
      ) 
        {
           parent::__construct($context); 
           $this->_scopeConfig = $scopeConfig;
        }
         
            public function getEnable(){
                return $this->_scopeConfig->getValue(self::ENABLE);
            }
         
            public function getPlan(){
                return $this->_scopeConfig->getValue(self::PLAN);
            }
         
            public function getPayment(){
                return $this->_scopeConfig->getValue(self::DOWN_PAYMENT);
            }
}