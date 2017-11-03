<?php
namespace WDPH\Megamenu\Model\Attribute;

class Floattype extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
	public function getAllOptions()
	{
		if (!$this->_options) {
			$this->_options = [
				['value' => '', 'label' => __('Default')],
				['value' => 'right', 'label' => __('Right')],
                ['value' => 'left', 'label' => __('Left')]                				
			];
		}
		return $this->_options;
	}
}
?>