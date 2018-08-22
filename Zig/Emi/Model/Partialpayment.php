<?php
/**
* 
*
*/

namespace Zig\Emi\Model;

class Partialpayment extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('Zig\Emi\Model\ResourceModel\Partialpayment');
    }
}