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

    // AJAX Load more for front page
    if ('undefined' !== typeof (avocado_front_page)) {

        var currentPage = 1;
        var currentPostCount = avocado_front_page.post_count;
        var totalPages = avocado_front_page.total_pages;

        var loadingStart = function() {
            $(".front-page-load-more").addClass('loading');
            $(".front-page-load-more").html(avocado_obj.loading);
        }

        var loadingCompleted = function() {
            $(".front-page-load-more").removeClass("loading");
            $(".front-page-load-more").html(avocado_obj.load_more);
        };

        if (currentPage < totalPages) {

            // On click for load more button
            $('body ').on('click', '.front-page-load-more:not(.loading)', function() {

                loadingStart();

                // AJAX request to fetch post data
                var request = $.post(avocado_obj.ajax_url, {
                    action: 'load_phone_app_ajax_hook',
                    security: avocado_obj.ajax_nonce,
                    data: {
                        currentPage: currentPage,
                        currentPostCount: currentPostCount
                    }
                });

                request.done(function(response) {

                    loadingCompleted();

                    if (response.success) {

                        var postData = response.data.content;
                        $(".front-page-grid-items").append(postData);

                        currentPage = response.data.current_page;
                        currentPostCount = response.data.post_count;
                        totalPages = response.data.total_page;

                        if (currentPage == totalPages) {
                            $(".front-page-load-more").hide();
                        }
                    }

                });

                request.fail(function() {
                    loadingCompleted();
                });
            });
        }

    }

}
)(jQuery);
