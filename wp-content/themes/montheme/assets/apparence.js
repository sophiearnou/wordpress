// on utilise une fonction qui prends en paramètre jquery et on entre son code
(function ($) {

    wp.customize('header_background', function (value) {
        value.bind(function (newVal) {
            $('.navbar').attr('style', 'background:' + newVal + '!important');
        });
    });

})(jQuery);