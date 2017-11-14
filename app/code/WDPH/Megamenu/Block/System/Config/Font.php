<?php
namespace WDPH\Megamenu\Block\System\Config;

class Font extends \Magento\Config\Block\System\Config\Form\Field
{    
    public function __construct(\Magento\Backend\Block\Template\Context $context, array $data = [])
	{        
        parent::__construct($context, $data);
    }
    
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
		$id = $element->getHtmlId();
        $html = $element->getElementHtml();        
        $html .= '<br/><div id="wdph_googlefont_preview' . $id . '" style="font-size:20px; margin-top:5px;">The quick
        brown fox jumps over the lazy dog</div>
		<script>
		require(["jquery"], function ($)
		{
			function refreshPreview' . $id . '()
			{
				if(loadedFonts' . $id . '.indexOf(fontElement' . $id . '.val()) > -1)
				{
					previewElement' . $id . '.css("fontFamily", fontElement' . $id . '.val());
					return;
				}
				var ss = document.createElement("link");
				ss.type = "text/css";
				ss.rel = "stylesheet";
				ss.href = "//fonts.googleapis.com/css?family=" + fontElement' . $id . '.val();
				$("head").append(ss);

				previewElement' . $id . '.css("fontFamily", fontElement' . $id . '.val());

				loadedFonts' . $id . ' += fontElement' . $id . '.val() + ",";
			}			
			
			var fontElement' . $id . ' = $("#'. $id .'");
			var previewElement' . $id . ' = $("#wdph_googlefont_preview' . $id . '");
			var loadedFonts' . $id . ' = "";
			
			refreshPreview' . $id . '();
			
			fontElement' . $id . '.on("change", function() { refreshPreview' . $id . '(); });
			fontElement' . $id . '.on("keyup", function() { refreshPreview' . $id . '(); });			
			fontElement' . $id . '.on("keydown", function() { refreshPreview' . $id . '(); });			
		});
		</script>
        ';       
        return $html;
    }
}
?>