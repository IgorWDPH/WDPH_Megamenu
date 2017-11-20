<?php
namespace WDPH\Megamenu\Block\Html;

class Navigation extends \Magento\Catalog\Block\Navigation
{
	public $megamenuHelper;
	protected $catalogCategoryHelper;
	protected $flatState;
	protected $storeManager;
	protected $filterProvider;
	protected $categoriesCustomStyles;
	
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
	
	public function renderCategoriesMenuHtml($sidebar = false)
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
		$this->categoriesCustomStyles = '<style type="text/css">';
		$html .= $this->renderHomeItem();
		foreach ($activeCategories as $category)
		{			
            $html .= $this->renderCategoryMenuItemHtml($category, $menuDepth, $sidebar);
        }
		$this->categoriesCustomStyles .= '</style>';
		$html .= $this->categoriesCustomStyles;
		return $html;
	}
	
	protected function getStoreCategories()
    {
        return $this->catalogCategoryHelper->getStoreCategories();
    }
	
	protected function renderCategoryMenuItemHtml($category, $menuDepth, $sidebar, $level = 0, $isWide = false)
	{		
		if (!$category->getIsActive() || $category->getData('wdph_megamenu_hide_item') || (intval($menuDepth) && $menuDepth <= $level))
		{
            return '';
        }		
		$html = '';
		$categoryId = $category->getId();
		$additionalLiClasses = '';
		$sidebarClass = '';		
		$this->setCategoriesCustomStyles($category);		
		$catDropDownType = '';
		if(!$sidebar)
		{
			$additionalLiClasses .= ($category->getData('wdph_megamenu_float') ? ' wdph-item-float-' . $category->getData('wdph_megamenu_float') : '');
			if($level > 0)
			{
				$catDropDownType = 'classic';
			}
			else
			{
				$catDropDownType = $category->getData('wdph_megamenu_dropdown_type');
				$catDropDownType = ($catDropDownType ? $catDropDownType : $this->megamenuHelper->getConfig('general/menu_type'));
				if($catDropDownType == 'staticwidth')
				{
					$additionalLiClasses .= ' wdph-dropdown-type-fullwidth';
				}
				else
				{
					$additionalLiClasses .= ' wdph-dropdown-type-' . $catDropDownType;
				}
			}
		}
		else
		{
			$sidebarClass = 'sidebar';
		}
		$catAddLabel = $category->getData('wdph_megamenu_cat_label');
		if($catAddLabel)
		{
			$catAddLabel = '<span class="wdph-megamenu-item-add-label">' . $this->megamenuHelper->getConfig('general/' . $catAddLabel) . '</span>';
		}		
		$html .= '<li id="wdph-megamenu-category-' . $categoryId . '" class="wdph-megamenu-item level-' . $level . ' ' . $additionalLiClasses . $sidebarClass . '"><a class="item-link" href="' .
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
			$subMenuStyles = '';
			$subMenuClass = '';
			$subMenuUlStyles = '';
			if(!$sidebar)
			{
				if(($catDropDownType == 'fullwidth' || $catDropDownType == 'staticwidth') && $level == 0)
				{
					$ulWidth = 100;					
					$blockCont = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_top_block_con');
					if($blockCont)
					{
						$dropdownTopBlock = '<div class="wdph_megamenu-dropdown-top">' . $blockCont . '</div>';
					}
					$blockCont = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_bot_block_cont');
					if($blockCont)
					{
						$dropdownBottomBlock = '<div class="wdph_megamenu-dropdown-bottom">' . $blockCont . '</div>';
					}
					$blockCont = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_left_block_cont');
					$blockWidth = $category->getData('wdph_megamenu_left_block_w');
					if($blockCont && $blockWidth)
					{
						$ulWidth -= $blockWidth;
						$dropdownLeftBlock = '<div class="wdph_megamenu-dropdown-left"' . ($blockWidth ? " style=\"width: $blockWidth%;\" " : '') . '>' . $blockCont . '</div>';
					}
					$blockCont = $this->getCategoryDropdownAdditionalContent($category, 'wdph_megamenu_right_block_cont');
					$blockWidth = $category->getData('wdph_megamenu_right_block_w');
					if($blockCont && $blockWidth)
					{
						$ulWidth -= $blockWidth;
						$dropdownRightBlock = '<div class="wdph_megamenu-dropdown-right"' . ($blockWidth ? " style=\"width: $blockWidth%;\" " : '') . '>' . $blockCont . '</div>';
					}
					$subMenuUlStyles = " width: $ulWidth%;";
					$subMenuClass .= ' ' . ($this->megamenuHelper->getConfig('appearance/submenu_columns') ? $this->megamenuHelper->getConfig('appearance/submenu_columns') : 'columns-four');
				}				
				if($catDropDownType == 'staticwidth' && $level == 0)
				{
					$staticWidth = (trim($category->getData('wdph_megamenu_static_width')) ? trim($category->getData('wdph_megamenu_static_width')) : trim($this->megamenuHelper->getConfig('general/static_width')));
					$subMenuStyles .= ' width: ' . $staticWidth . ';';
				}				
			}			
			$html .= '<div class="wdph-megamenu-submenu level' . $level . ' ' . $sidebarClass . ' ' . $subMenuClass . '" style="' . $subMenuStyles . '">' . $dropdownTopBlock . $dropdownLeftBlock . '<ul class="" style="' . $subMenuUlStyles . '">';
			foreach ($children as $child)
			{
				$html .= $this->renderCategoryMenuItemHtml($child, $menuDepth, $sidebar, $level + 1, $isWide);
			}
			$html .= '</ul>' . $dropdownRightBlock . $dropdownBottomBlock . '</div>';
		}		
		$html .= '</li>';
		return $html;
	}
	
	protected function setCategoriesCustomStyles($category)
	{		
		$categoryId = $category->getId();		
		if(trim($category->getData('wdph_megamenu_font_color')))
		{
			$this->categoriesCustomStyles .= ' .wdph-megamenu-container .wdph-megamenu-navigation-container li#wdph-megamenu-category-' . $categoryId . '>a.item-link:first-child { color: ' . trim($category->getData('wdph_megamenu_font_color')) . '; }';
		}		
		if(trim($category->getData('wdph_megamenu_font_hcolor')))
		{
			$this->categoriesCustomStyles .= ' .wdph-megamenu-container .wdph-megamenu-navigation-container li.visible#wdph-megamenu-category-' . $categoryId . '>a.item-link:first-child { color: ' . trim($category->getData('wdph_megamenu_font_hcolor')) . '; }';
		}		
		if(trim($category->getData('wdph_megamenu_item_back_c')))
		{
			$this->categoriesCustomStyles .= ' .wdph-megamenu-container .wdph-megamenu-navigation-container li#wdph-megamenu-category-' . $categoryId . '>a.item-link:first-child { background-color: ' . trim($category->getData('wdph_megamenu_item_back_c')) . '; }';
		}		
		if(trim($category->getData('wdph_megamenu_item_hover_c')))
		{
			$this->categoriesCustomStyles .= ' .wdph-megamenu-container .wdph-megamenu-navigation-container li.visible#wdph-megamenu-category-' . $categoryId . '>a.item-link:first-child { background-color: ' . trim($category->getData('wdph_megamenu_item_hover_c')) . '; }';
		}		
		if(trim($category->getData('wdph_megamenu_drop_back_c')))
		{
			$this->categoriesCustomStyles .= ' .wdph-megamenu-container .wdph-megamenu-navigation-container li#wdph-megamenu-category-' . $categoryId . '>.wdph-megamenu-submenu { background-color: ' . trim($category->getData('wdph_megamenu_drop_back_c')) . '; }';
		}		
		if(trim($category->getData('wdph_megamenu_drop_back_i')))
		{
			$this->categoriesCustomStyles .= ' .wdph-megamenu-container .wdph-megamenu-navigation-container li#wdph-megamenu-category-' . $categoryId . '>.wdph-megamenu-submenu { background-image: url(' . $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/category/' . trim($category->getData('wdph_megamenu_drop_back_i')) . '); }';
		}	
	}
	
	protected function renderHomeItem()
	{
		if($this->megamenuHelper->getConfig('general/home'))
		{
			return '<li class="wdph-megamenu-item level-0"><a class="item-link" href="' . $this->storeManager->getStore()->getBaseUrl() . '"><span class="wdph-megamenu-item-label">' . __('Home') . '</span></a></li>';
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