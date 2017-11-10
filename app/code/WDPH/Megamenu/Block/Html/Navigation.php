<?php
namespace WDPH\Megamenu\Block\Html;

class Navigation extends \Magento\Catalog\Block\Navigation
{
	public $megamenuHelper;
	protected $catalogCategoryHelper;
	protected $flatState;
	protected $storeManager;
	protected $filterProvider;
	
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
								\Magento\Catalog\Model\CategoryFactory $categoryFactory,
								\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
								\Magento\Catalog\Model\Layer\Resolver $layerResolver,
								\Magento\Framework\App\Http\Context $httpContext,
								\Magento\Catalog\Helper\Category $catalogCategoryHelper,
								\Magento\Framework\Registry $registry,
								\Magento\Catalog\Model\Indexer\Category\Flat\State $flatState,
								\Magento\Store\Model\StoreManagerInterface $storeManager,
								\Magento\Cms\Model\Template\FilterProvider $filterProvider,
								\WDPH\Megamenu\Helper\Data $megamenuHelper,
								array $data = [])
	{
		$this->flatState = $flatState;
		$this->catalogCategoryHelper = $catalogCategoryHelper;
		$this->storeManager = $storeManager;
		$this->filterProvider = $filterProvider;
		$this->megamenuHelper = $megamenuHelper;
		parent::__construct($context, $categoryFactory, $productCollectionFactory, $layerResolver, $httpContext, $catalogCategoryHelper, $registry, $flatState, $data);		
    }
	
	public function renderCategoriesMenuHtml()
	{
		$activeCategories = [];
		foreach($this->getStoreCategories() as $child)
		{
            if($child->getIsActive())
			{
                $activeCategories[] = $child;
            }
        }
		$menuDepth = $this->megamenuHelper->getConfig('general/visible_menu_depth');
		$html = '';
		$html .= $this->renderHomeItem();
		foreach ($activeCategories as $category)
		{			
            $html .= $this->renderCategoryMenuItemHtml($category, $menuDepth);
        }
		return $html;
	}
	
	protected function getStoreCategories()
    {
        return $this->catalogCategoryHelper->getStoreCategories();
    }
	
	protected function renderCategoryMenuItemHtml($category, $menuDepth, $level = 0)
	{		
		if (!$category->getIsActive() || $category->getData('wdph_megamenu_hide_item') || (intval($menuDepth) && $menuDepth <= $level))
		{
            return '';
        }
		$html = '';
		$additionalLiClasses = '';
		$catDropDownType = $category->getData('wdph_megamenu_dropdown_type');
		$catAddLabel = $category->getData('wdph_megamenu_cat_label');
		if($catAddLabel)
		{
			$catAddLabel = '<span class="wdph-megamenu-item-add-label">' . $this->megamenuHelper->getConfig('general/' . $catAddLabel) . '</span>';
		}			
		$additionalLiClasses .= ' wdph-dropdown-type-' . ($catDropDownType ? $catDropDownType : $this->megamenuHelper->getConfig('general/menu_type'));
		$additionalLiClasses .= ($category->getData('wdph_megamenu_float') ? ' wdph-item-float-' . $category->getData('wdph_megamenu_float') : '');
		$html .= '<li class="wdph-megamenu-item level-' . $level . ' ' . $additionalLiClasses . '"><a class="" href="' .
					(trim($category->getData('wdph_megamenu_item_url')) ? trim($category->getData('wdph_megamenu_item_url')) : $this->getCategoryUrl($category)) .
					'"><span class="wdph-megamenu-item-label">' . $this->escapeHtml($category->getName()) . '</span>' . $catAddLabel . '</a>';
		if ($this->flatState->isFlatEnabled())
		{			
            $children = (array)$category->getChildrenNodes();
			$childrenCount = count($children);
        }
		else
		{
            $children = $category->getChildren();   
			$childrenCount = $children->count();			
        }
		if($childrenCount && (!intval($menuDepth) || (intval($menuDepth) && $menuDepth > $level + 1)))
		{
			$dropdownTopBlock = '';
			$dropdownBottomBlock = '';
			$dropdownLeftBlock = '';
			$dropdownRightBlock = '';
			if($catDropDownType != 'classic' && $level == 0)
			{				
				$dropdownTopBlock = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_top_block_con');
				if($dropdownTopBlock)
				{
					$dropdownTopBlock = '<div class="wdph_megamenu-dropdown-top">' . $dropdownTopBlock . '</div>';
				}
				$dropdownBottomBlock = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_bot_block_cont');
				if($dropdownBottomBlock)
				{
					$dropdownBottomBlock = '<div class="wdph_megamenu-dropdown-bottom">' . $dropdownBottomBlock . '</div>';
				}
				$dropdownLeftBlock = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_left_block_cont');
				if($dropdownLeftBlock)
				{
					$dropdownLeftBlock = '<div class="wdph_megamenu-dropdown-left"' . (trim($category->getData('wdph_megamenu_left_block_w')) ? ' style="width:"' . $category->getData('wdph_megamenu_left_block_w') . ';"' : '') . '>' . $dropdownLeftBlock . '</div>';
				}
				$dropdownRightBlock = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_right_block_cont');
				if($dropdownRightBlock)
				{
					$dropdownRightBlock = '<div class="wdph_megamenu-dropdown-right"' . (trim($category->getData('wdph_megamenu_left_block_w')) ? ' style="width:"' . $category->getData('wdph_megamenu_right_block_w') . ';"' : '') . '>' . $dropdownRightBlock . '</div>';
				}
			}
			$html .= '<div class="wdph-megamenu-submenu level' . $level . '">' . $dropdownTopBlock . $dropdownLeftBlock . '<ul class="">';
			foreach ($children as $child)
			{
				$html .= $this->renderCategoryMenuItemHtml($child, $menuDepth, $level + 1);
			}
			$html .= '</ul>' . $dropdownBottomBlock . $dropdownRightBlock . '</div>';
		}
		$html .= '</li>';
		return $html;
	}
	
	protected function renderHomeItem()
	{
		if($this->megamenuHelper->getConfig('general/home'))
		{
			return '<li class="wdph-megamenu-item level-0"><a class="" href="' . $this->storeManager->getStore()->getBaseUrl() . '"><span class="wdph-megamenu-item-label">' . __('Home') . '</span></a></li>';
		}
		return '';
	}
	
	protected function getCategoryDropdownAdditionalContent($category, $attrId)
	{
		return $this->filterProvider->getBlockFilter()->filter(trim($category->getData($attrId)));
	}
	
	public function renderBlockBeforeMenu()
	{
		if($this->megamenuHelper->getConfig('general/staticblock_before'))
		{
			return $this->getCMSBlock($this->megamenuHelper->getConfig('general/staticblock_before'));
		}
	}
	
	public function renderBlockAfterMenu()
	{
		if($this->megamenuHelper->getConfig('general/staticblock_after'))
		{
			return $this->getCMSBlock($this->megamenuHelper->getConfig('general/staticblock_after'));
		}
	}
	
	protected function getCMSBlock($blockId)
	{
		return $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId($blockId)->toHtml();
		//Ptovider for getting html content from attribute 
		//return $this->filterProvider->getBlockFilter()->filter(trim($blockId));
	}	
}
?>