<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Zig\Emi\Block\Adminhtml\Order;

/**
 * Adminhtml order totals block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Totals extends \Magento\Framework\View\Element\Template
{
    /**
     * Initialize order totals array
     *
     * @return $this
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);   
    }

    

    public function initTotals()
    {
        $parent = $this->getParentBlock();
        
        $paid = $parent->getSource()->getDepositAmount();
        $total = $parent->getSource()->getGrandTotal();

        $remaining = $total - $paid;

        $custom11 = new \Magento\Framework\DataObject(
            [
                'code' => 'paid_amountt',
                'strong' => true,
                'value' => $paid,
                'base_value' => $paid,
                'label' => __('Paid Amount'),
                'area' => 'footer',
            ]
        );

        $custom22 = new \Magento\Framework\DataObject(
            [
                'code' => 'remaining_admin',
                'strong' => true,
                'value' => $remaining,
                'base_value' => $remaining,
                'label' => __('Remaining Amount'),
                'area' => 'footer',
            ]
        );

        $parent->addTotal($custom11,'xyz');
        $parent->addTotal($custom22,'xyz');
        // $parent->removeTotal('paid');
        // $parent->removeTotal('refunded');
        // $parent->removeTotal('due');


        return $this;
    }
}
