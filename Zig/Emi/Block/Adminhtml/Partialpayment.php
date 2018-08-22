<?php
namespace Zig\Emi\Block\Adminhtml;

class Partialpayment extends \Magento\Backend\Block\Widget\Grid\Container
{

	protected function _construct()
	{
		$this->_controller = 'adminhtml_partial';
		$this->_blockGroup = 'Zig_Emi';
		$this->_headerText = __('Partial Payment');
		$this->_addButtonLabel = __('Create New Order');
		parent::_construct();
	}
}

