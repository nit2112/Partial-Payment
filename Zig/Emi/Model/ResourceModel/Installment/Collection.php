<?php
/**
* 
*
*/

namespace Zig\Emi\Model\ResourceModel\Installment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        parent::_construct();
        // $this->_init('partialpayment/partialpayment');
        $this->_init('Zig\Emi\Model\Installment', 'Zig\Emi\Model\ResourceModel\Installment');
    }
}