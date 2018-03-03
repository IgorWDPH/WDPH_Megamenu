<?php
namespace WDPH\Megamenu\Model\Config;

class Cmsblockselector implements \Magento\Framework\Option\ArrayInterface
{
	protected $optionsCollection;
	
	public function __construct(\Magento\Cms\Model\BlockFactory $blockFactory)
	{
		$this->optionsCollection = $this->_sort($blockFactory->create()->getCollection());		
    }
	
	protected function _sort($collection)
	{
		$optionsCollection = array();
		foreach($collection as $block)
		{
			$optionsCollection[$block->getIdentifier()] = $block->getTitle();
		}
		asort($optionsCollection);
		return $optionsCollection;
	}
	
    public function toOptionArray()
    {		
		$options = array();
		$options[] = ['value' => '', 'label' => __('Choose a block...')];
		foreach($this->optionsCollection as $key => $value)
		{
			$options[] = ['value' => $key, 'label' => $value];
		}
        return $options;
    }

    public function toArray()
    {
		$options = array('0' => 'Choose a block...') + $this->optionsCollection;
        return $options;
    }
}
?>