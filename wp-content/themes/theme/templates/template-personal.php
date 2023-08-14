<?php

/**

 * Template Name: Персональная страница

 */

get_header();



global $post;



if( !is_user_logged_in() ) {

    return;

}



$user = wp_get_current_user();

?>

<main class="container">

    <section>

        <?php if( function_exists('kama_breadcrumbs') ): kama_breadcrumbs(); endif; ?>

        <div class="account">

            <div class="account__aside">

                <div class="account__block">

                    <div class="account__pill">

                        <div class="account__pill-picture"><?php echo get_avatar(get_current_user_id(), 50); ?></div>

                        <div class="account__pill-name"><?=$user->display_name ?></div>

                    </div>

                    <ul class="account__menu">

                            
                        <?php if(0): ?>
                        <li<?php echo ($post->post_name == 'announcements')?' class="active"':''; ?>><a href="<?php the_permalink(98); ?>"><span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M18.3332 10H13.3332L11.6665 12.5H8.33317L6.6665 10H1.6665" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            <path d="M4.5415 4.25831L1.6665 9.99998V15C1.6665 15.442 1.8421 15.8659 2.15466 16.1785C2.46722 16.4911 2.89114 16.6666 3.33317 16.6666H16.6665C17.1085 16.6666 17.5325 16.4911 17.845 16.1785C18.1576 15.8659 18.3332 15.442 18.3332 15V9.99998L15.4582 4.25831C15.3202 3.98064 15.1075 3.74696 14.844 3.58355C14.5805 3.42014 14.2766 3.33348 13.9665 3.33331H6.03317C5.7231 3.33348 5.41922 3.42014 5.15571 3.58355C4.89219 3.74696 4.67949 3.98064 4.5415 4.25831V4.25831Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            </svg></span>My announcements</a></li>
						                       
						
						<li<?php echo ($post->post_name == 'notification')?' class="active"':''; ?>><a href="<?php the_permalink(96); ?>"><span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 6.66669C15 5.3406 14.4732 4.06883 13.5355 3.13115C12.5979 2.19347 11.3261 1.66669 10 1.66669C8.67392 1.66669 7.40215 2.19347 6.46447 3.13115C5.52678 4.06883 5 5.3406 5 6.66669C5 12.5 2.5 14.1667 2.5 14.1667H17.5C17.5 14.1667 15 12.5 15 6.66669Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.4414 17.5C11.2949 17.7526 11.0846 17.9622 10.8316 18.1079C10.5786 18.2537 10.2918 18.3304 9.99977 18.3304C9.70779 18.3304 9.42093 18.2537 9.16792 18.1079C8.9149 17.9622 8.70461 17.7526 8.55811 17.5" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							
							</svg></span>Notifications</a></li> 
						 <?php endif; ?>


                        <!--<li<?php echo ($post->post_name == 'activity')?' class="active"':''; ?>><a href="<?php the_permalink(100); ?>"><span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M3.33317 3.33331H16.6665C17.5832 3.33331 18.3332 4.08331 18.3332 4.99998V15C18.3332 15.9166 17.5832 16.6666 16.6665 16.6666H3.33317C2.4165 16.6666 1.6665 15.9166 1.6665 15V4.99998C1.6665 4.08331 2.4165 3.33331 3.33317 3.33331Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            <path d="M18.3332 5L9.99984 10.8333L1.6665 5" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            </svg></span>Activity Overview</a></li> -->

                        <li<?php echo ($post->post_name == 'saved')?' class="active"':''; ?>><a href="<?php the_permalink(102); ?>"><span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M17.3666 3.84166C16.941 3.41583 16.4356 3.07803 15.8794 2.84757C15.3232 2.6171 14.727 2.49847 14.1249 2.49847C13.5229 2.49847 12.9267 2.6171 12.3705 2.84757C11.8143 3.07803 11.3089 3.41583 10.8833 3.84166L9.99994 4.725L9.1166 3.84166C8.25686 2.98192 7.0908 2.49892 5.87494 2.49892C4.65908 2.49892 3.49301 2.98192 2.63327 3.84166C1.77353 4.70141 1.29053 5.86747 1.29053 7.08333C1.29053 8.29919 1.77353 9.46525 2.63327 10.325L3.5166 11.2083L9.99994 17.6917L16.4833 11.2083L17.3666 10.325C17.7924 9.89937 18.1302 9.39401 18.3607 8.83779C18.5912 8.28158 18.7098 7.6854 18.7098 7.08333C18.7098 6.48126 18.5912 5.88508 18.3607 5.32887C18.1302 4.77265 17.7924 4.26729 17.3666 3.84166V3.84166Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            </svg></span>Saved Publications</a></li>

						
                        <li<?php echo ($post->post_name == 'personal')?' class="active"':''; ?>><a href="<?php the_permalink(94); ?>"><span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512 14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014 3.3335 14.9493 3.3335 15.8333V17.5" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            <path d="M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238 11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889 9.16667 9.99984 9.16667Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            </svg></span>Personal data</a></li>
						
						
                        <li<?php echo ($post->post_name == 'support')?' class="active"':''; ?>><a href="<?php the_permalink(3485); ?>"><span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">

                            <path d="M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512 14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014 3.3335 14.9493 3.3335 15.8333V17.5" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            <path d="M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238 11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889 9.16667 9.99984 9.16667Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                            </svg></span>Support</a></li>
						
						

                    </ul>

                </div>

            </div>

            <?php get_template_part( 'templates/personal/page', $post->post_name ); ?>

        </div>

    </section>

</main>

<?php get_footer(); ?>