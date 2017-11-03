<?php
namespace WDPH\Megamenu\Model\Attribute;

class Catlabel extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
	protected $dataHelper;
	
	public function __construct(\WDPH\Megamenu\Helper\Data $dataHelper) {
        $this->dataHelper = $dataHelper;
    }
	
	public function getAllOptions()
	{
		if (!$this->_options) {
			$this->_options = [
				['value' => '', 'label' => __('No Label')],
                ['value' => 'label1', 'label' => $this->dataHelper->getConfig('general/label1')],
                ['value' => 'label2', 'label' => $this->dataHelper->getConfig('general/label2')],
                ['value' => 'label3', 'label' => $this->dataHelper->getConfig('general/label3')]              				
			];
		}
		return $this->_options;
	}
}
?>