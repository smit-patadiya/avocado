(function($) {

    // Filter OS
    $('body.home #site-navigation #primary-menu .menu-item-object-os a').on('click', function(event) {
        event.preventDefault();

        var itemLink = $(event.target).attr('href').replace(/^\/|\/$/g, '');
        var selectedOsSlugs = itemLink.split('/').reverse();
        var selectedOs = (selectedOsSlugs.length) ? selectedOsSlugs[0] : '';

        if ('' !== selectedOs) {
            $('.front-page-grid-items .type-phone_app.grid-item:not(.os-' + selectedOs + ')').fadeOut();
            $('.front-page-grid-items .type-phone_app.grid-item.os-' + selectedOs).fadeIn();
        }

        $('#site-navigation #primary-menu .menu-item').removeClass('active-filter');
        $(event.target).parent('.menu-item').addClass('active-filter');

    });

    // Display All OS
    $('body.home #site-navigation #primary-menu .menu-item-filter-allapp a').on('click', function(event) {

        event.preventDefault();
        $('.front-page-grid-items .type-phone_app.grid-item').fadeIn();

    });

}
)(jQuery);
