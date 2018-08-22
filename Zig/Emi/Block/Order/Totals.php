<?php
namespace Zig\Emi\Block\Order;

use Magento\Sales\Model\Order;
 
class Totals extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Order
     */
    protected $_logger;
    protected $_order;
    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;
 
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Psr\Log\LoggerInterface $logger,
        array $data = []
    ) {
        parent::__construct($context, $data);   
    }
     

    public function initTotals()
    {
         /**
        *Emi Paid amount
        */
        $parent = $this->getParentBlock();
        $this->_source = $parent->getSource();
    

        $custom1 = new \Magento\Framework\DataObject(
            [
                'code' => 'paid_amount',
                'field' => 'paid_amount',
                'strong' => true,
                'value' => $this->_source->getDepositAmount(), //$source->getDepositAmount(),
                'label' => __('Paid Amount'),
            ]
        );

        $custom2 = new \Magento\Framework\DataObject(
            [
                'code' => 'remaining_amount',
                'field' => 'remaining_amount',
                'strong' => true,
                'value' => (($this->_source->getGrandTotal())-($this->_source->getDepositAmount())),
                'label' => __('Remaining Amount'),
            ]
        );

        /**
        *end emi
        */
        $parent->addTotal($custom1, 'totals');
        $parent->addTotal($custom2, 'totals');

        return $this;
    }
   
}