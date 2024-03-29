<?php
namespace WDPH\Megamenu\Model\Attribute;

class Menutype extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
	public function getAllOptions()
	{
		if (!$this->_options) {
			$this->_options = [
				['value' => '', 'label' => __('Default')],
				['value' => 'classic', 'label' => __('Classic')],
				['value' => 'fullwidth', 'label' => __('Full Width')],
				['value' => 'staticwidth', 'label' => __('Static Width')]				
			];
		}
		return $this->_options;
	}
}
?>