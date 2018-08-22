<?php
/**
 *
 */
namespace Zig\Emi\Model\System\Config;

class Col implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1,   'label'=>__('Weekly')),
            array('value' => 2,   'label'=>__('Monthly')),
            array('value' => 3,   'label'=>__('Yearly')),
        );
    }
}