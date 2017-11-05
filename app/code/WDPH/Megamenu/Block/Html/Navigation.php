<?php
namespace WDPH\Megamenu\Block\Html;

class Navigation extends \Magento\Catalog\Block\Navigation
{
	protected $megamenuHelper;
	protected $catalogCategoryHelper;
	protected $flatState;
	
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
								\Magento\Catalog\Model\CategoryFactory $categoryFactory,
								\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
								\Magento\Catalog\Model\Layer\Resolver $layerResolver,
								\Magento\Framework\App\Http\Context $httpContext,
								\Magento\Catalog\Helper\Category $catalogCategoryHelper,
								\Magento\Framework\Registry $registry,
								\Magento\Catalog\Model\Indexer\Category\Flat\State $flatState,
								\WDPH\Megamenu\Helper\Data $megamenuHelper,
								array $data = [])
	{
		$this->flatState = $flatState;
		$this->catalogCategoryHelper = $catalogCategoryHelper;
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
		$html = '';
		foreach ($activeCategories as $category)
		{			
            $html .= $this->renderCategoryMenuItemHtml($category);
        }
		return $html;
	}
	
	protected function renderCategoryMenuItemHtml($category, $level = 0)
	{		
		if (!$category->getIsActive())
		{
            return '';
        }
		$html = '';
		$prefix = '';
		$levelLocal = $level;
		while($levelLocal > 0)
		{
			$prefix .= '-';
			$levelLocal--;
		}	
		$html .= '<p>' . $prefix . $this->escapeHtml($category->getName()) . '</p>';
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
		if($childrenCount)
		{			
			foreach ($children as $child)
			{
				$html .= $this->renderCategoryMenuItemHtml($child, $level + 1);
			}
		}
		return $html;
	}
	
	public function getStoreCategories()
    {
        return $this->catalogCategoryHelper->getStoreCategories();
    }
}
?>