(function ($) {

    function FrontPageFunc () {

        this.menuItems = $('#primary-menu .menu-item');
        this.appGridItemSelector = '.front-page-grid-items .type-phone_app.grid-item';
        this.currentPage = 1;
        this.currentPostCount = 0;
        this.totalPages = 0;
        this.loadMoreButton = $(".front-page-load-more");
        this.ajaxUrl = avocado_obj.ajax_url;
        this.ajaxNonce = avocado_obj.ajax_nonce;
        this.textLoading = avocado_obj.loading;
        this.textLoadMore = avocado_obj.load_more;
    }

    //The init function
    FrontPageFunc.prototype.init = function () {

        if ('undefined' !== typeof (avocado_front_page)) {
            this.currentPostCount = avocado_front_page.post_count;
            this.totalPages = avocado_front_page.total_pages;
        }

        this.bindEvents();

    }

    //Get Selected OS based on selected filter
    FrontPageFunc.prototype.getSelectedOs = function (eventTarget) {

        var itemLink = $(eventTarget).attr('href').replace(/^\/|\/$/g, '');
        var selectedOsSlugs = itemLink.split('/').reverse();
        return (selectedOsSlugs.length) ? selectedOsSlugs[0] : '';

    }

    //Bind Events
    FrontPageFunc.prototype.bindEvents = function () {

        //Filter OS based selected filter
        this.handleFilterOs = this.handleFilterOs.bind(this);
        $(document).on('click', '#primary-menu .menu-item-object-os a', this.handleFilterOs);

        //Display All OS
        this.handleDisplayAllOs = this.handleDisplayAllOs.bind(this);
        $(document).on('click', '#primary-menu .menu-item-filter-allapp a', this.handleDisplayAllOs);

        //Load More Apps on click
        if (this.currentPage < this.totalPages) {

            this.handleOnClickLoadMore = this.handleOnClickLoadMore.bind(this);
            $(document).on('click', '.front-page-load-more:not(.loading)', this.handleOnClickLoadMore);

        }
    }

    //Change color of active filter link
    FrontPageFunc.prototype.handleActiveFilterLinkStyle = function (eventTarget) {
        
        that.menuItems.removeClass('active-filter');
        $(eventTarget).parent('.menu-item').addClass('active-filter');
    
    }

    //Filter OS based selected filter
    FrontPageFunc.prototype.handleFilterOs = function (event) {

        var that = this;
        event.preventDefault();

        var selectedOs = that.getSelectedOs(event.target);
        if ('' !== selectedOs) {
            $(that.appGridItemSelector + ':not(.os-' + selectedOs + ')').hide();
            $(that.appGridItemSelector + '.os-' + selectedOs).show();
        }

        that.handleActiveFilterLinkStyle(event.target)

    }

    //Diplay All OS
    FrontPageFunc.prototype.handleDisplayAllOs = function (event) {

        var that = this;
        event.preventDefault();

        $(that.appGridItemSelector).show();
        that.handleActiveFilterLinkStyle(event.target)

    }

    //Loading Start
    FrontPageFunc.prototype.loadingStart = function () {

        this.loadMoreButton.addClass('loading');
        this.loadMoreButton.html(avocado_obj.loading);

    }

    //Loading Completed
    FrontPageFunc.prototype.loadingCompleted = function () {

        this.loadMoreButton.removeClass('loading');
        this.loadMoreButton.html(avocado_obj.load_more);

    }

    //Hanlde Load More AJAX
    FrontPageFunc.prototype.handleOnClickLoadMore = function () {

        var that = this;

        that.loadingStart();

        // AJAX request to fetch post data
        var request = $.post(that.ajaxUrl, {
            action: 'load_phone_app_ajax_hook',
            security: that.ajaxNonce,
            data: {
                currentPage: that.currentPage,
                currentPostCount: that.currentPostCount
            }
        });

        request.done(function (response) {

            that.loadingCompleted();

            if (response.success) {

                var postData = response.data.content;
                $(".front-page-grid-items").append(postData);

                that.currentPage = response.data.current_page;
                that.currentPostCount = response.data.post_count;
                that.totalPages = response.data.total_page;

                if (that.currentPage == that.totalPages) {

                    that.loadMoreButton.hide();

                }
            }

        });

        request.fail(function () {

            that.loadingCompleted();

        });

    }

    //Initialize Front Page functionality 
    if ('undefined' !== typeof (avocado_obj) && avocado_obj.isFrontPage) {

        var frontPage = new FrontPageFunc();
        frontPage.init();

    }

}
)(jQuery);
