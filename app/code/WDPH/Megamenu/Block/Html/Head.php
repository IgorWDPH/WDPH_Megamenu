<?php
namespace WDPH\Megamenu\Block\Html;

class Head extends \Magento\Framework\View\Element\Template
{
	public $megamenuHelper;
	
	public function __construct(\WDPH\Megamenu\Helper\Data $megamenuHelper, \Magento\Framework\View\Element\Template\Context $context)
	{
		$this->megamenuHelper = $megamenuHelper;
		parent::__construct($context);
	}
	
	public function getMainFont()
	{		
		return $this->megamenuHelper->getConfig('appearance/google_font');		
	}
	
	public function getCustomCss()
	{
		return trim($this->megamenuHelper->getConfig('appearance/custom_styles'));
	}
	
	public function getCustomJs()
	{
		return trim($this->megamenuHelper->getConfig('appearance/custom_js'));
	}
}
?>