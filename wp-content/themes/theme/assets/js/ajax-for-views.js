// этот ajax запрос отвечает за отправку просмотра при клике
// let url = "<?php echo template_dir_uri; ?>";
    $(document).ready(function(){
        // $('.view_click').click(function(e){
        $(document).on('click' , '.view_click', function(){
            // e.preventDefault();
            //отправка id поста на сервер
            let post = $(this).parents('.views-click').attr('product-id');
            $.ajax( '/riza/wp-content/themes/theme/server/views.php', {
                method: 'post',
                data: {
                    "post": post
                },
                datatype: "html",
                success: function (data) {
                    console.log(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
            console.log(post);
        })

    })
