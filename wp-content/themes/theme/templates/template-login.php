<?php

/**

 * Template Name: Страница входа

 */

get_header();

?>

<main class="container">

    <div class="reg">

        <div class="reg__block">

            <h1><?php the_title(); ?></h1>

            <div class="reg__form">

                <form id="login-form">

                    <div class="field"><input type="text" name="login" placeholder="Login"></div>

                    <div class="field"><input type="password" name="password" placeholder="Password"></div>

                    <div class="field">

                        <button class="btn" type="submit">Login</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

<?php get_footer(); ?>