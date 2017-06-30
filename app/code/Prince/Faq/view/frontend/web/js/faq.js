define ([
    'jquery', 
    'jquery/ui'
], function($){
    'use strict';

    return function (config) {
        var active = config.defaultActive;
        var animateSpeed = config.animateSpeed;
        
        $( ".faq-accordion" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: parseInt(active),
            animate: parseInt(animateSpeed)
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
    };
});