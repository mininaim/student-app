(function ($) {
    $.fn.ajax_delete = function (settings) {
        settings = $.extend({
            post: 'delete-tag',
            element: '',
            msg: 'Are you sure?'
        }, settings);
        $(this)
            .click(function () {

            var id = $(this)
                .attr('id')
            var parent = $(this)
                .parent();
            var body = settings.element + '#' + id;


            $.ajax({
                type: 'POST',
                data: settings.post + '=' + id,
                success: function (msg) {
                    if (settings.element) {
                        $(body).remove();

                    } else {
                        parent.fadeOut('slow', 0.5, function () {
                            $(this).remove();
                        });
                    }
                }
            });

            return false;
        });
    };
})(jQuery);