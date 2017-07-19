require ([
    "jquery", 
    "jquery/ui"
], function($){
    $(".faq-accordion").accordion({
        collapsible: true,
        heightStyle: "content",
        active: '',
        animate: 500
    });

    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    }); 
});