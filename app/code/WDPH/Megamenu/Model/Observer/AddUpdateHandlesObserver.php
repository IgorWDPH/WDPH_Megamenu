<?php
namespace WDPH\Megamenu\Model\Observer;

class AddUpdateHandlesObserver implements \Magento\Framework\Event\ObserverInterface
{    
	protected $megamenuHelper;
    
    public function __construct(\WDPH\Megamenu\Helper\Data $customTabsHelper)
    {
		$this->megamenuHelper = $customTabsHelper;
    }
   
    public function execute(\Magento\Framework\Event\Observer $observer)
    {		
        if(!$this->megamenuHelper->getConfig('general/enable'))
		{
            return $this;
        }		
		$observer->getData('layout')->getUpdate()->addHandle('wdph_megamenu_default_lay');		
        return $this;
    }
}
?>