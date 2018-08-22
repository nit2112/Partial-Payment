<?php
/**
 *
 */
namespace Zig\Emi\Helper;

/**
 * Adminhtml Catalog helper
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Calculation extends \Magento\Framework\App\Helper\AbstractHelper
{


	protected $_helper;

	public function __construct(\Psr\Log\LoggerInterface $logger,\Zig\Emi\Helper\Data $helper)
	{
	    $this->logger = $logger;
	    $this->_helper= $helper;	 
	}



	public function remainingInstallment($subTotal)
	{
		$downpayment = $this->_helper->getPayment();

		if(isset($downpayment))
		{
			return ($subTotal - (($subTotal * $downpayment) / 100));
				
		}
	}


}