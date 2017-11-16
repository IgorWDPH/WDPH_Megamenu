require(["jquery"], function ($)
{	
	$(document).ready(function()
	{
		//SET COLORS BEGIN
		function getItemAdData(item)
		{
			var adData = item.attr('addata');
			if(typeof adData !== typeof undefined && adData !== false)
			{
				adData = $.parseJSON(adData);
				return adData;
			}
			return false;
		}
		
		$(".wdph-megamenu-container .wdph-megamenu-navigation-container li").each(function()
		{
			var adData = getItemAdData($(this));
			if(adData)
			{				
				$(this).find(">a.item-link:first-child").css('color', adData['wdph_megamenu_font_color']);				
			}			
		});
		$(".wdph-megamenu-container .wdph-megamenu-navigation-container li").on('mouseover', function()
		{
			$(this).find(">.wdph-megamenu-submenu").addClass('visible');
			var adData = getItemAdData($(this));
			if(adData)
			{
				$(this).css('background-color', adData['wdph_megamenu_item_hover_c']);
				$(this).find(">a.item-link:first-child").css('color', adData['wdph_megamenu_font_hcolor']);
			}
		});
		$(".wdph-megamenu-container .wdph-megamenu-navigation-container li").on('mouseout', function()
		{
			$(this).find(">.wdph-megamenu-submenu").removeClass('visible');
			var adData = getItemAdData($(this));
			if(adData)
			{
				$(this).css('background-color', '');
				$(this).find(">a.item-link:first-child").css('color', adData['wdph_megamenu_font_color']);
			}
		});
		//SET COLORS END
	});
});