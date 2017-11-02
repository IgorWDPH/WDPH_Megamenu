<?php
namespace WDPH\Megamenu\Model\Attribute;

class Selecttype extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
		if (!$this->_options)
		{
			$this->_options = [
				['value' => '0', 'label' => __('NONE')],
				['value' => '1', 'label' => __('1')],
				['value' => '2', 'label' => __('2')],
				['value' => '3', 'label' => __('3')],
				['value' => '4', 'label' => __('4')],
				['value' => '5', 'label' => __('5')],
				['value' => '6', 'label' => __('6')],
				['value' => '7', 'label' => __('7')],
				['value' => '8', 'label' => __('8')],
				['value' => '9', 'label' => __('9')],                
			];
		}        
		return $this->_options;
	}
}
?>