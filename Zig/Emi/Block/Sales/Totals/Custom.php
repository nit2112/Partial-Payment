<?php

namespace Zig\Emi\Block\Sales\Totals;


class Custom extends \Magento\Framework\View\Element\Template {

protected $_order;
protected $_source;

public function __construct(\Magento\Framework\View\Element\Template\Context $context,
    array $data = []
    ) {
    parent :: __construct($context, $data);
} 

public function getSource() {
    return $this ->_source;
} 

public function getStore() {
    return $this ->_order -> getStore();
} 

public function getOrder() {
    return $this ->_order;
} 


public function initTotals() {
    $parent = $this->getParentBlock();
    $this ->_order = $parent->getOrder();
    $this ->_source = $parent->getSource();

    $custom = new \Magento\Framework\DataObject([
        'code' => 'custom',
        'strong' => false,
        'value' => '',
        'label' =>__('Test Amountyy'),
        ]
        );

    $parent->addTotal($custom, 'custom');

    return $this;
} 
} 