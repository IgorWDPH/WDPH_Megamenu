<?php
namespace WDPH\Megamenu\Block\Html;

class Navigation extends \Magento\Catalog\Block\Navigation
{
	protected $topMenuBlock;
	
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
								Magento\Catalog\Model\CategoryFactory $categoryFactory,
								Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
								Magento\Catalog\Model\Layer\Resolver $layerResolver,
								Magento\Framework\App\Http\Context $httpContext,
								Magento\Catalog\Helper\Category $catalogCategoryHelper,
								Magento\Framework\Registry $registry,
								Magento\Catalog\Model\Indexer\Category\Flat\State, $flatState,
								array $data = [])
	{
		parent::__construct($context, $categoryFactory, $productCollectionFactory, $layerResolver, $httpContext, $catalogCategoryHelper, $registry, $flatState, $data);
    }
}
?>