require(["jquery"], function ($)
{
	$(document).ready(function()
	{		
		$(".wdph-megamenu-container .wdph-megamenu-navigation-container li.wdph-megamenu-item").on('mouseenter', function()
		{			
			if($(this).find(">.wdph-megamenu-submenu").length)
			{
				var subMenu = $(this).find(">.wdph-megamenu-submenu");
				subMenu.addClass('visible');				
				if(parseInt(subMenu.outerWidth()) + parseInt(subMenu.offset().left) > $(window).width())
				{					
					subMenu.addClass('right');
				}
				subMenu.css('visibility', 'visible');	
			}						
		});
		$(".wdph-megamenu-container .wdph-megamenu-navigation-container li.wdph-megamenu-item").on('mouseleave', function()
		{
			$(this).removeClass('visible');
			if($(this).find(">.wdph-megamenu-submenu").length)
			{
				var subMenu = $(this).find(">.wdph-megamenu-submenu");
				subMenu.removeClass('visible').removeClass('right');
				subMenu.css('visibility', 'hidden');
			}			
		});
	});
});