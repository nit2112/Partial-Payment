<?php
/**
* 
* 
*
*/

namespace Zig\Emi\Model\ResourceModel;

class Installment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {    
        // Note that the partial_payment_id refers to the key field in your database table.
        $this->_init('partial_payment_installment', 'installment_id');
    }
}