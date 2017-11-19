<?php
namespace WDPH\Megamenu\Model\Config;

class Submenucolumns implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
			['value' => 'columns-two', 'label' => __('2')],
            ['value' => 'columns-three', 'label' => __('3')],
            ['value' => 'columns-four', 'label' => __('4')],
			['value' => 'columns-five', 'label' => __('5')],
			['value' => 'columns-six', 'label' => __('6')]
        ];
    }

    public function toArray()
    {
        return [
			'columns-two' => __('2'),
            'columns-three' => __('3'),
            'columns-four' => __('4'),
			'columns-five' => __('5'),
			'columns-six' => __('6')
        ];
    }
}