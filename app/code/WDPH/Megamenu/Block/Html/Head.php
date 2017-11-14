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
		/*$config_fonts = array(
			'main/font',
			'navigation/top_nav_font',
			'footer/footer_title_font',
			'main/title_font',
			'main/price_font',
			'product_listing/product_name_font',
			'sidebar/block_title_font',
			'product_info/title_font',
			'product_info/price_font',
			'content_banners/content_banner_font',
		);
		if ($athleteHelper->getAppearanceCfg('main/enable_font')) {
			foreach ($config_fonts as $_cfont) {
				$_font = $athleteHelper->getAppearanceCfg($_cfont);
				if ( !empty($_font) && !in_array($_font, $fontsToLoad) ) {
					$fontsToLoad[] = "{$_font}:300,400,600,700,800";
				}
			}
		}
		?>
		<?php if ( !empty($fontsToLoad) ) : ?>
			<link href='//fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', implode('|', $fontsToLoad) ); ?>' rel='stylesheet' type='text/css'>
		<?php endif; ?>*/
		if($this->megamenuHelper->getConfig('appearance/google_font'))
		{			
			return $this->megamenuHelper->getConfig('appearance/google_font');
		}
	}
}
?>