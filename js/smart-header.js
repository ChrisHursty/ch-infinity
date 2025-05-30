document.addEventListener('DOMContentLoaded', function() {
    var lastScrollTop = 0;
    var header = document.getElementById('masthead'); // Replace with your header ID
    var startSmartBehavior = 120; // Start the smart behavior after 120px of scrolling

    window.addEventListener('scroll', function() {
        var currentScroll = window.scrollY;

        if (currentScroll > lastScrollTop && currentScroll > startSmartBehavior) {
            // Scrolling down and past 120px
            header.style.top = '-90px'; // Adjust as needed
        } else if (currentScroll <= lastScrollTop || currentScroll <= startSmartBehavior) {
            // Scrolling up or hasn't scrolled 120px yet
            header.style.top = '0';
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    }, false);
});

jQuery(document).ready(function($) {
    $('.main-navigation li:has(ul)').children('a').addClass('sub-menu-toggle').click(function(e) {
        var $submenu = $(this).next('ul');
        if ($submenu.is(':visible')) {
            $submenu.slideUp().find('ul').slideUp();
            $(this).removeClass('active');
        } else {
            $submenu.slideDown();
            $(this).addClass('active');
        }
        // For mobile, prevent the default navigation to the link if it has a sub-menu
        if ($(this).hasClass('sub-menu-toggle')) {
            e.preventDefault();
        }
    });
    $('.menu-item-has-children > a').append(' <i class="fas fa-caret-down"></i>');
    $('.menu-item-has-children > a').on('click', function(e) {
        e.preventDefault(); // Prevent navigation to "#" link
        
        // Toggle current menu's visibility
        var $parentLi = $(this).parent('li');
        
        // Toggle caret icon for current menu
        $(this).children('i').toggleClass('fa-caret-down fa-caret-up');
        // Close other open sub-menus and reset their caret icons
        $('.menu-item-has-children').not($parentLi).find('.sub-menu').slideUp();
        $('.menu-item-has-children').not($parentLi).find('i').removeClass('fa-caret-up').addClass('fa-caret-down');
    });
});