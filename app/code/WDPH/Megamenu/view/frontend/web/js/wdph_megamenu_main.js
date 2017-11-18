require(["jquery"], function ($)
{	
	$(document).ready(function()
	{		
		$(".wdph-megamenu-container .wdph-megamenu-navigation-container li").on('mouseover', function()
		{
			$(this).addClass('visible')
			$(this).find(">.wdph-megamenu-submenu").addClass('visible');			
		});
		$(".wdph-megamenu-container .wdph-megamenu-navigation-container li").on('mouseout', function()
		{
			$(this).removeClass('visible');
			$(this).find(">.wdph-megamenu-submenu").removeClass('visible');			
		});		
	});
});