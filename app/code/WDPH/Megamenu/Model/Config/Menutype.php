<?php
namespace WDPH\Megamenu\Model\Config;

class Menutype implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
			['value' => 'classic', 'label' => __('Classic')],
            ['value' => 'fullwidth', 'label' => __('Full Width')],
            ['value' => 'staticwidth', 'label' => __('Static Width')]            
        ];
    }

    public function toArray()
    {
        return [
			'classic' => __('Classic'),
            'fullwidth' => __('Full Width'),
            'staticwidth' => __('Static Width')            
        ];
    }
}