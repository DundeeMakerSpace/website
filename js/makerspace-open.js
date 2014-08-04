(function($){

    var active_class = 'is-shown';
    var $notification = $('#space-status-notification');
    var $notification_close = $('#space-status-notification__close');

    setTimeout(function(){
        $notification.addClass(active_class);
    },1000);

    $notification_close.on('click', function(){
        $notification.removeClass(active_class);
    });

})(jQuery);