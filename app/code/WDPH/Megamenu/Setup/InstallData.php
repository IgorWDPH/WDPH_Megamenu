<?php 
namespace WDPH\Megamenu\Setup;
 
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;
 
class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;
 
	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}
 
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_hide_item', [
            'type'		=> 'int',
            'label'    	=> 'Hide Menu Item',
            'input'    	=> 'boolean',
            'source'   	=> 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  	=> true,
            'default'  	=> '0',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_shide_item', [
            'type'		=> 'int',
            'label'    	=> 'Hide Menu Item',
            'input'    	=> 'boolean',
            'source'   	=> 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  	=> true,
            'default'  	=> '0',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_hide_sub', [
            'type'		=> 'int',
            'label'    	=> 'Show Sub-Categories',
            'input'    	=> 'boolean',
            'source'   	=> 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  	=> true,
            'default'  	=> '0',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_dropdown_type', [
            'type'		=> 'varchar',
            'label'    	=> 'Dropdown Type',
            'input' 	=> 'select',
            'source' 	=> 'WDPH\Megamenu\Model\Attribute\Menutype',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_static_width', [
            'type' 		=> 'varchar',
            'label'    	=> 'Static Width',
            'input' 	=> 'text',                       
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_item_url', [
            'type' 		=> 'varchar',
            'label'    	=> 'Custom URL',
            'input' 	=> 'text',                       
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_float', [
            'type'		=> 'varchar',
            'label'    	=> 'Float',
            'input' 	=> 'select',
            'source' 	=> 'WDPH\Megamenu\Model\Attribute\Floattype',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_cat_label', [
            'type'		=> 'varchar',
            'label'    	=> 'Category Label',
            'input' 	=> 'select',
            'source' 	=> 'WDPH\Megamenu\Model\Attribute\Catlabel',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_top_block_con', [
            'type' 		=> 'text',
			'label' 	=> 'Top Block Content',
			'input' 	=> 'textarea',
			'required' 	=> false,			
			'wysiwyg_enabled' 			=> true,
			'is_html_allowed_on_front' 	=> true,
			'global' 	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
			'group' 	=> 'WDPH Megamenu'
        ]);		
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_bot_block_cont', [
            'type' 		=> 'text',
			'label' 	=> 'Bottom Block Content',
			'input' 	=> 'textarea',
			'required' 	=> false,			
			'wysiwyg_enabled' 			=> true,
			'is_html_allowed_on_front' 	=> true,
			'global' 	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
			'group' 	=> 'WDPH Megamenu'
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_left_block_cont', [
            'type' 		=> 'text',
			'label' 	=> 'Left Block Content',
			'input' 	=> 'textarea',
			'required' 	=> false,			
			'wysiwyg_enabled' 			=> true,
			'is_html_allowed_on_front' 	=> true,
			'global' 	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
			'group' 	=> 'WDPH Megamenu'
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_left_block_w', [
            'type' 		=> 'varchar',
            'label'    	=> 'Left Block Width',
            'input' 	=> 'text',                       
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_right_block_cont', [
            'type' 		=> 'text',
			'label' 	=> 'Right Block Content',
			'input' 	=> 'textarea',
			'required' 	=> false,			
			'wysiwyg_enabled' 			=> true,
			'is_html_allowed_on_front' 	=> true,
			'global' 	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
			'group' 	=> 'WDPH Megamenu'
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_right_block_w', [
            'type' 		=> 'varchar',
            'label'    	=> 'Right Block Width',
            'input' 	=> 'text',                       
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_item_back_c', [
            'type' 		=> 'varchar',
            'label'    	=> 'Item Background Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_item_hover_c', [
            'type' 		=> 'varchar',
            'label'    	=> 'Item Hover Background Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_drop_back_c', [
            'type' 		=> 'varchar',
            'label'    	=> 'Dropdown Background Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);		
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_drop_back_i', [
            'type' 		=> 'varchar',
            'label' 	=> 'Dropdown Background Image',
            'input' 	=> 'image',
			'backend' 	=> 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_font_color', [
            'type' 		=> 'varchar',
            'label'    	=> 'Font Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_font_hcolor', [
            'type' 		=> 'varchar',
            'label'    	=> 'Hover Font Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_font_scol', [
            'type' 		=> 'varchar',
            'label'    	=> 'Sidebar Font Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_font_shcol', [
            'type' 		=> 'varchar',
            'label'    	=> 'Sidebar Hover Font Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_font_sbcol', [
            'type' 		=> 'varchar',
            'label'    	=> 'Sidebar Item Background Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_megamenu_font_shbcol', [
            'type' 		=> 'varchar',
            'label'    	=> 'Sidebar Hover Item Background Color',
            'input' 	=> 'text',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$setup->endSetup();
	}
}
?>