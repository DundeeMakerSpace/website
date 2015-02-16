(function($){
    $('html').removeClass('no-js');
    $('html').addClass('js');

    // Nice navigation
    $('#main-nav-sidr').sidr({
        source: '#tp-nav-main-nav',
        side: 'right'
    });

    $('.listing-table').footable({
        breakpoints: {
            phone: 490,
            tablet: 960
        }
    });
    var $filter = $('.listing-table-filter');

    $filter.before('<a href="#" class="icon-search listing-table-filter-toggle" id="listing-table-filter-toggle"><span class="screen-reader-text">Show Search Tool</span></a>');

    $('body').on('click', '#listing-table-filter-toggle', function(e){
        e.preventDefault();
        $filter.slideToggle();
    });
})(jQuery);