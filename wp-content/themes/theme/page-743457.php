<?php

/**

 * Template Name: Страница удаления аккаунта

 */

get_header();

?>
<main class="container">
    <h2 style="text-align: center">Please provide the email address associated with your account, and we will delete your account within 10 days</h2>
<div class="delete__password">
    <?php echo do_shortcode('[wpforms id="743611"]')?>
</div>


</main>
<style>
    h2{
        max-width: 1000px;
        margin: 40px auto 0;
    }
    div.wpforms-container-full input[type=email]:focus{
        border: 1px solid #8F00FF !important;
        box-shadow: 0 0 0 1px #8F00FF !important,0px 1px 2px rgba(0,0,0,0.15);
    }
    .delete__password {
        width: fit-content;
        margin: 0 auto;
        padding: 0 10px 40px;
    }
    .delete__password label {
        padding: 7px 0 7px 0;
    }
    .delete__password .wpforms-submit.btn {
        display: inline-block;
        padding: 8px 32px;
        background-color: #8F00FF !important;
        border: 1px solid #8F00FF;
        color: #FFFFFF;
        letter-spacing: 0.2px;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        margin: 0 0 0 0;
        border-radius: 31px;
        font-weight: 600;
        font-size: 18px;
        line-height: 22px;
        /* text-align: center; */
    }
    div.wpforms-container-full input[type=submit]:focus:after,
    div.wpforms-container-full button[type=submit]:focus:after,
    div.wpforms-container-full .wpforms-page-button:focus:after {
        display: none !important;
    }
    .wpforms-container .wpforms-submit-container {
        padding: 0 !important;
    }
</style>
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $('.submit_click').on('click', function(){-->
<!--            let email = $('.delete__password form .email').val();-->
<!--            let password = $('.delete__password form .password').val();-->
<!--            $.ajax( '/wp-content/themes/theme/server/delete-account.php', {-->
<!--                method: 'post',-->
<!--                data: {-->
<!--                    'email': email,-->
<!--                    "password": password-->
<!--                },-->
<!--                datatype: "html",-->
<!--                success: function (data) {-->
<!--                    console.log('прошло');-->
<!--                    console.log(data);-->
<!--                },-->
<!--                error: function (jqXHR, exception) {-->
<!--                    var msg = '';-->
<!--                    if (jqXHR.status === 0) {-->
<!--                        msg = 'Not connect.\n Verify Network.';-->
<!--                    } else if (jqXHR.status == 404) {-->
<!--                        msg = 'Requested page not found. [404]';-->
<!--                    } else if (jqXHR.status == 500) {-->
<!--                        msg = 'Internal Server Error [500].';-->
<!--                    } else if (exception === 'parsererror') {-->
<!--                        msg = 'Requested JSON parse failed.';-->
<!--                    } else if (exception === 'timeout') {-->
<!--                        msg = 'Time out error.';-->
<!--                    } else if (exception === 'abort') {-->
<!--                        msg = 'Ajax request aborted.';-->
<!--                    } else {-->
<!--                        msg = 'Uncaught Error.\n' + jqXHR.responseText;-->
<!--                    }-->
<!--                    console.log(msg);-->
<!--                }-->
<!--            });-->
<!--        })-->
<!--    })-->
<!--</script>-->
<?php get_footer(); ?>
