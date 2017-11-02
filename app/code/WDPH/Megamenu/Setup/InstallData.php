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
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_test_attr_0', [
            'type'		=> 'int',
            'label'    	=> 'Boolean Attr',
            'input'    	=> 'boolean',
            'source'   	=> 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'visible'  	=> true,
            'default'  	=> '0',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_test_attr_1', [
            'type'		=> 'varchar',
            'label'    	=> 'Select Attr',
            'input' 	=> 'select',
            'source' 	=> 'WDPH\Megamenu\Model\Attribute\Selecttype',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_test_attr_2', [
            'type' 		=> 'text',
            'label'    	=> 'Text Area',
            'input' 	=> 'textarea',                        
            'required' 	=> false,
			'wysiwyg_enabled' => true,
			'is_html_allowed_on_front' => true,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_test_attr_3', [
            'type' 		=> 'varchar',
            'label' 	=> 'Image',
            'input' 	=> 'image',
			'backend' 	=> 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		$eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'wdph_test_attr_4', [
            'type' 		=> 'varchar',
            'label'    	=> 'Text Attr',
            'input' 	=> 'text',                       
            'required' 	=> false,
            'global'   	=> \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'group'    	=> 'WDPH Megamenu',
        ]);
		
		$setup->endSetup();
	}
}
?>