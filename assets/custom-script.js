(function($) {
    $(document).ready(function() {
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {action: 'get_three_oldest_posts'},
            dataType: 'json',
            success: function(data) {
                let section = $('<section>').addClass("oldest_posts_container");
                $('body').append(section);
                $.each(data, function(key, value) {
                    console.log(value);
                    let p = $('<div>').html(value);
                    section.append(p);
                });
            }
        });
    });
})(jQuery);
