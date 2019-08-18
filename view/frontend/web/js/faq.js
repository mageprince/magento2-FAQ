define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    return function (config) {

        setAccordian();

        function setAccordian() {
            $(".faq-accordion").accordion({
                collapsible: true,
                heightStyle: "content",
                active: '',
                animate: 500
            });
        }

        function scrollToGroup(data) {
            var target = $(data.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top
                }, 1000);
            }
        }

        $('.group-link').on('click', function(event) {
            if (config.pageType == 'scroll') {
                scrollToGroup(this);
            } else {
                var self = this;
                event.preventDefault();
                var groupId = $(this).attr('groupid');
                var groupUrl = config.ajax_url + 'faq/index/ajax';
                $.ajax({
                    url: groupUrl,
                    type: 'POST',
                    dataType: 'json',
                    showLoader: true,
                    data: {
                        groupId: groupId
                    },
                    complete: function(response) {
                        $('#faq-content').html(response.responseJSON.faq);
                        setAccordian();
                        scrollToGroup(self);
                    }
                });
            }
        });
    }
});
