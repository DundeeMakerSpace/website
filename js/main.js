(function($){
    $('html').removeClass('no-js');
    $('html').addClass('js');

    var slideout = new Slideout({
        'panel': document.getElementById('main-wrapper'),
        'menu': document.getElementById('main-header'),
        'padding': 256,
        'tolerance': 70
    });

    document.getElementById('nav-toggle').addEventListener('click', function() {
        slideout.toggle();
        return false;
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