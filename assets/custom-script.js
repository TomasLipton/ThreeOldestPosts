(function($) {
    $(document).ready(function() {
        $.ajax({
            url: ajaxurl,
            type: 'post',
            data: {action: 'get_three_oldest_posts'},
            dataType: 'json',
            success: function(data) {
                const section = document.createElement("section");
                section.classList.add("oldest_posts_container");
                const body = document.querySelector("body");
                body.appendChild(section);

                for (let value of Object.values(data)) {
                    console.log(value);
                    const p = document.createElement("div");
                    p.innerHTML = value;
                    section.appendChild(p);
                }

            }
        });
    });
})(jQuery);
