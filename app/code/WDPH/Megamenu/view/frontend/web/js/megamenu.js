define([
    "jquery",
    "jquery/ui",
    "domReady!",
], function($)
{
    $.widget('mage.wktestrequire',
    {
        options:
        {

        },
        _create: function()
        {
            console.log('from megamenu.js');
            $(".wdph-megamenu-container .wdph-megamenu-navigation-container li.wdph-megamenu-item").on('mouseenter', function()
            {
                $(this).addClass('visible');
                if($(this).find(">.wdph-megamenu-submenu").length && $(window).width() > 767)
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
                if($(this).find(">.wdph-megamenu-submenu").length && $(window).width() > 767)
                {
                    var subMenu = $(this).find(">.wdph-megamenu-submenu");
                    subMenu.removeClass('visible').removeClass('right');
                    subMenu.css('visibility', 'hidden');
                }
            });
            $("li.wdph-megamenu-item .toggle-plus").on('click', function()
            {
                var li = $(this).closest("li.wdph-megamenu-item");
                $(this).css('display', 'none');
                li.children(".toggle-minus").css('display', 'block');
                li.children(".wdph-megamenu-submenu").css('display', 'block');
            });
            $("li.wdph-megamenu-item .toggle-minus").on('click', function()
            {
                var li = $(this).closest("li.wdph-megamenu-item");
                $(this).css('display', 'none');
                li.children(".toggle-plus").css('display', 'block');
                li.children(".wdph-megamenu-submenu").css('display', 'none');
            });
            $(".wdph-megamenu-navigation-container .toggle-mobile-nav").on('click', function()
            {
                var ulContainer = $(this).closest(".wdph-megamenu-navigation-container").children(".wdph-megamenu");
                if(ulContainer.hasClass('mobile-menu-visible'))
                {
                    ulContainer.removeClass('mobile-menu-visible');
                }
                else
                {
                    ulContainer.addClass('mobile-menu-visible');
                }
            });
        },
    });
    return $.mage.wktestrequire;
});

