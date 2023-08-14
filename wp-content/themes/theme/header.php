<!doctype html>
<html<?php language_attributes();?>>
<head>
    <link rel="icon" type="image/png" href="https://discount.one/wp-content/uploads/2023/06/cropped-logo_kubic-1.png" />
    <script type="application/ld+json">
	{
		"@context":"http:\/\/schema.org",
		"@type":"Organization",
		"url":"https:\/\/discount.one",
		"brand":"Discount.one",
		"logo":"https:\/\/discount.one\/wp-content\/uploads\/2023\/03\/logo_kubic.svg",
		"email":"commerce@discount.one",
		"sameAs":[
			"https:\/\/t.me\/discount_one",
			"https:\/\/mojapp.in\/@discount_one",
			"https:\/\/www.hipi.co.in\/@discountone"
			]
	}
    </script>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <META content="General" name="rating">
    <META name="ROBOTS" content="ALL">
    <meta name="verify-admitad" content="2e4ed8ebec" />
    <?php wp_head(); ?>

    <!-- Mobile Specific Metas -->
    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
		
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PH7PLFB');</script>
    <!-- End Google Tag Manager -->


</head>
<?php
if( is_user_logged_in() ){
    $user = wp_get_current_user();
    $avatar = get_avatar_url( wp_get_current_user(), array(
        'size' => 50,
    ) );
}

$class = '';

if( is_page() ) {
    global $post;
    $class .= $post->post_name .'-page';
}
?>
<body class="<?php echo $class; ?>">
	<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PH7PLFB"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
	
    <header>
        <div class="container">
            <div class="header">
                <div class="header__logo">
                    <a href="#" class="header__back"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 10.75C16.4142 10.75 16.75 10.4142 16.75 10C16.75 9.58579 16.4142 9.25 16 9.25L16 10.75ZM3.46967 9.46967C3.17678 9.76256 3.17678 10.2374 3.46967 10.5303L8.24264 15.3033C8.53553 15.5962 9.01041 15.5962 9.3033 15.3033C9.59619 15.0104 9.59619 14.5355 9.3033 14.2426L5.06066 10L9.3033 5.75736C9.59619 5.46447 9.59619 4.98959 9.3033 4.6967C9.01041 4.40381 8.53553 4.40381 8.24264 4.6967L3.46967 9.46967ZM16 9.25L4 9.25L4 10.75L16 10.75L16 9.25Z" fill="#A3A3A3"/></svg></a>
                    <a href="/"><img src="<?php echo TEMPLATE_DIR_URI; ?>/images/logo.svg" alt=""></a>
                </div>
                <div class="header__nav">
                    <?php
                    if ( has_nav_menu( 'main' ) ) {
                        wp_nav_menu(
                            array(
                                'container'  => false,
                                'menu_class'  => '',
                                'theme_location' => 'main',
                            )
                        );
                    } ?>
                    <?php $args = wp_get_nav_menus( 'main' ); ?>

                    <div> <?php wp_get_nav_menus( 'main' ) ?> </div>

                </div>
                <?php echo get_search_form(); ?>
                <?php if( get_field('allowed_coupons', 'options') ): ?>
                <div class="header__button">
                    <a href="#" class="btn">Place an ad</a>
                </div>
                <?php endif; ?>
                <?php if( is_user_logged_in() ): ?>
                <div class="header__notify">
                    <a href="#" class="notify__icon action__notify">
                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.6376 21.0975L24.3826 20.8725C23.6592 20.2279 23.026 19.4888 22.5001 18.675C21.9258 17.5519 21.5815 16.3254 21.4876 15.0675V11.3625C21.4926 9.3867 20.7759 7.47709 19.4722 5.99247C18.1684 4.50784 16.3675 3.55038 14.4076 3.29999V2.33249C14.4076 2.06694 14.3021 1.81227 14.1143 1.6245C13.9266 1.43673 13.6719 1.33124 13.4063 1.33124C13.1408 1.33124 12.8861 1.43673 12.6984 1.6245C12.5106 1.81227 12.4051 2.06694 12.4051 2.33249V3.31499C10.4628 3.58343 8.68358 4.54668 7.39699 6.02632C6.11041 7.50596 5.40365 9.40172 5.4076 11.3625V15.0675C5.31366 16.3254 4.96943 17.5519 4.3951 18.675C3.87826 19.4867 3.25524 20.2258 2.5426 20.8725L2.2876 21.0975V23.2125H24.6376V21.0975Z" fill="#737373"/>
                            <path d="M11.4902 24C11.556 24.4754 11.7916 24.911 12.1534 25.2262C12.5153 25.5415 12.979 25.7151 13.459 25.7151C13.9389 25.7151 14.4026 25.5415 14.7645 25.2262C15.1264 24.911 15.362 24.4754 15.4277 24H11.4902Z" fill="#737373"/>
                        </svg>
                        <span>0</span>
                    </a>
                    <div class="notify__content">
                        <div class="notify__title">
                            Notifications
                            <span></span>
                            <a href="#" class="notify__remove">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V9C18 7.9 17.1 7 16 7H8C6.9 7 6 7.9 6 9V19ZM18 4H15.5L14.79 3.29C14.61 3.11 14.35 3 14.09 3H9.91C9.65 3 9.39 3.11 9.21 3.29L8.5 4H6C5.45 4 5 4.45 5 5C5 5.55 5.45 6 6 6H18C18.55 6 19 5.55 19 5C19 4.45 18.55 4 18 4Z" fill="#A3A3A3"/>
                                </svg>
                            </a>
                        </div>
                        <div class="notify__list">
                            <!-- <div class="notify__item">
                                <div class="notify__item-top">
                                    New sale
                                    <a href="#" class="notify__item-close">
                                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.2002 1.69995L10.8002 11.3M10.8002 1.69995L1.2002 11.3" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="notify__item-content">
                                    <div class="notify__item-image"><img src="" alt=""></div>
                                    <div class="notify__item-text">Don't miss all promotions</div>
                                    <div class="notify__item-button">
                                        <a href="#" class="btn btn-border">To the promotion</a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="header__user">
                    <div class="header__user-pill">
                        <?php if( is_user_logged_in() ): ?>
                        <div class="header__user-picture">
                            <?php if( !empty($avatar) ): ?><img src="<?=$avatar ?>" alt=""><?php endif; ?>
                        </div>
                        <div class="header__user-name">
                            <a href="#" class="action__openuser"><?php
                                if(strlen($user->display_name) > 8){
                                   echo mb_substr( $user->display_name, 0, 8 ). '...';
                                }else{
                                    echo mb_substr( $user->display_name, 0, 8 );
                                } ?></a>
                        </div>
                        <?php else: ?>
                        <div class="header__user-signup"><a href="/registration">Sign In</a></div>
                        <?php endif; ?>
                    </div>
                    <div class="header__mobile-item">
                        <div class="hidden__pic">
                            <?php if( is_user_logged_in() ): ?>
                            <a href="#" class="action__openuser">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <g clip-path="url(#clip0_3516_688)">
                                        <path d="M6.4 11.8008H13.6C15.0322 11.8008 16.4057 12.3697 17.4184 13.3824C18.4311 14.3951 19 15.7686 19 17.2008C19 17.6782 18.8104 18.136 18.4728 18.4736C18.1352 18.8111 17.6774 19.0008 17.2 19.0008H2.8C2.32261 19.0008 1.86477 18.8111 1.52721 18.4736C1.18964 18.136 1 17.6782 1 17.2008C1 15.7686 1.56893 14.3951 2.58162 13.3824C3.59432 12.3697 4.96783 11.8008 6.4 11.8008Z" stroke="#A5ABB8" stroke-width="1.5" stroke-miterlimit="10"/>
                                        <path d="M14.5 5.5C14.5 3.01472 12.4853 1 10 1C7.51472 1 5.5 3.01472 5.5 5.5V7.3C5.5 9.78528 7.51472 11.8 10 11.8C12.4853 11.8 14.5 9.78528 14.5 7.3V5.5Z" stroke="#A5ABB8" stroke-width="1.5" stroke-miterlimit="10"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_3516_688">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                                <?php else: ?>
                                        <div class="header__user-signup">
                                            <a href="/registration">Sign In</a>
                                        </div>
                                <?php endif; ?>
                        </div>
                    </div>
                    <?php if( is_user_logged_in() ): ?>
                    <ul class="header__user-menu">
                        <li class="header__user-title">
                            <div class="account__pill-picture">
                                <?php if( !empty($avatar) ): ?><img src="<?=$avatar ?>" alt=""><?php endif; ?>
                            </div>
                            <div class="account__pill-name">
                                <?=$user->display_name ?>
                                <span class="account__pill-email"><?=$user->user_email ?></span>
                            </div>
                        </li>
                        <?php if(0): ?>
                        <li><a href="<?php the_permalink(98); ?>"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.3332 10H13.3332L11.6665 12.5H8.33317L6.6665 10H1.6665" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.5415 4.25831L1.6665 9.99998V15C1.6665 15.442 1.8421 15.8659 2.15466 16.1785C2.46722 16.4911 2.89114 16.6666 3.33317 16.6666H16.6665C17.1085 16.6666 17.5325 16.4911 17.845 16.1785C18.1576 15.8659 18.3332 15.442 18.3332 15V9.99998L15.4582 4.25831C15.3202 3.98064 15.1075 3.74696 14.844 3.58355C14.5805 3.42014 14.2766 3.33348 13.9665 3.33331H6.03317C5.7231 3.33348 5.41922 3.42014 5.15571 3.58355C4.89219 3.74696 4.67949 3.98064 4.5415 4.25831V4.25831Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> My announcements</a>
                        </li>
                        <li><a href="<?php the_permalink(100); ?>"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.33317 3.33331H16.6665C17.5832 3.33331 18.3332 4.08331 18.3332 4.99998V15C18.3332 15.9166 17.5832 16.6666 16.6665 16.6666H3.33317C2.4165 16.6666 1.6665 15.9166 1.6665 15V4.99998C1.6665 4.08331 2.4165 3.33331 3.33317 3.33331Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18.3332 5L9.99984 10.8333L1.6665 5" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> Activity Overview</a></li>
                         <?php endif; ?>
                        <li><a href="<?php the_permalink(102); ?>"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.3666 3.84166C16.941 3.41583 16.4356 3.07803 15.8794 2.84757C15.3232 2.6171 14.727 2.49847 14.1249 2.49847C13.5229 2.49847 12.9267 2.6171 12.3705 2.84757C11.8143 3.07803 11.3089 3.41583 10.8833 3.84166L9.99994 4.725L9.1166 3.84166C8.25686 2.98192 7.0908 2.49892 5.87494 2.49892C4.65908 2.49892 3.49301 2.98192 2.63327 3.84166C1.77353 4.70141 1.29053 5.86747 1.29053 7.08333C1.29053 8.29919 1.77353 9.46525 2.63327 10.325L3.5166 11.2083L9.99994 17.6917L16.4833 11.2083L17.3666 10.325C17.7924 9.89937 18.1302 9.39401 18.3607 8.83779C18.5912 8.28158 18.7098 7.6854 18.7098 7.08333C18.7098 6.48126 18.5912 5.88508 18.3607 5.32887C18.1302 4.77265 17.7924 4.26729 17.3666 3.84166V3.84166Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> Saved Publications</a>
                        </li>
                         <li><a href="<?php the_permalink(94); ?>"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512 14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014 3.3335 14.9493 3.3335 15.8333V17.5" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238 11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889 9.16667 9.99984 9.16667Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> Personal data</a>
                         </li>

                        <li <?php echo ($post->post_name == 'support')?' class="active"':''; ?>><a href="<?php the_permalink(3485); ?>"><span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512 14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014 3.3335 14.9493 3.3335 15.8333V17.5" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238 11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889 9.16667 9.99984 9.16667Z" stroke="#404040" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg></span>Support</a>
                        </li>
                        <li class="header__user-exit"><a href="<?php echo wp_logout_url('/'); ?>"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 21C4.45 21 3.979 20.8043 3.587 20.413C3.19567 20.021 3 19.55 3 19V15H5V19H19V5H5V9H3V5C3 4.45 3.19567 3.979 3.587 3.587C3.979 3.19567 4.45 3 5 3H19C19.55 3 20.021 3.19567 20.413 3.587C20.8043 3.979 21 4.45 21 5V19C21 19.55 20.8043 20.021 20.413 20.413C20.021 20.8043 19.55 21 19 21H5ZM10.5 17L9.1 15.55L11.65 13H3V11H11.65L9.1 8.45L10.5 7L15.5 12L10.5 17Z" fill="#737373"/></svg> Exit</a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
<!--                <nav>-->
<!--                    <div class="nav__title_promo">-->
<!--                        <div class="nav__title_pict">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 48 48" fill="none">-->
<!--                                <g clip-path="url(#clip0_3319_45)">-->
<!--                                    <path d="M22 39C22 38.337 21.7366 37.7011 21.2678 37.2322C20.7989 36.7634 20.163 36.5 19.5 36.5C18.837 36.5 18.2011 36.7634 17.7322 37.2322C17.2634 37.7011 17 38.337 17 39H8.66667C8.22464 39 7.80072 38.8244 7.48816 38.5118C7.17559 38.1993 7 37.7754 7 37.3333V10.6667C7 10.2246 7.17559 9.80072 7.48816 9.48816C7.80072 9.17559 8.22464 9 8.66667 9H17C17 9.66304 17.2634 10.2989 17.7322 10.7678C18.2011 11.2366 18.837 11.5 19.5 11.5C20.163 11.5 20.7989 11.2366 21.2678 10.7678C21.7366 10.2989 22 9.66304 22 9H38.6667C39.1087 9 39.5326 9.17559 39.8452 9.48816C40.1577 9.80072 40.3333 10.2246 40.3333 10.6667V19.8333C39.2283 19.8333 38.1685 20.2723 37.3871 21.0537C36.6057 21.8351 36.1667 22.8949 36.1667 24C36.1667 25.1051 36.6057 26.1649 37.3871 26.9463C38.1685 27.7277 39.2283 28.1667 40.3333 28.1667V37.3333C40.3333 37.7754 40.1577 38.1993 39.8452 38.5118C39.5326 38.8244 39.1087 39 38.6667 39H22ZM19.5 21.5C20.163 21.5 20.7989 21.2366 21.2678 20.7678C21.7366 20.2989 22 19.663 22 19C22 18.337 21.7366 17.7011 21.2678 17.2322C20.7989 16.7634 20.163 16.5 19.5 16.5C18.837 16.5 18.2011 16.7634 17.7322 17.2322C17.2634 17.7011 17 18.337 17 19C17 19.663 17.2634 20.2989 17.7322 20.7678C18.2011 21.2366 18.837 21.5 19.5 21.5ZM19.5 31.5C20.163 31.5 20.7989 31.2366 21.2678 30.7678C21.7366 30.2989 22 29.663 22 29C22 28.337 21.7366 27.7011 21.2678 27.2322C20.7989 26.7634 20.163 26.5 19.5 26.5C18.837 26.5 18.2011 26.7634 17.7322 27.2322C17.2634 27.7011 17 28.337 17 29C17 29.663 17.2634 30.2989 17.7322 30.7678C18.2011 31.2366 18.837 31.5 19.5 31.5Z" fill="#7B30E6"/>-->
<!--                                </g>-->
<!--                                <defs>-->
<!--                                    <clipPath id="clip0_3319_45">-->
<!--                                        <rect width="48" height="48" fill="white"/>-->
<!--                                    </clipPath>-->
<!--                                </defs>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        --><?php //$term = get_term_by( 'slug', 'promo', 'promocodes', OBJECT );
//                            echo '<a href="'.get_term_link( $term->term_id ).'"class="nav__title"> Promo Codes</a>';
//                        ?>
<!--                    </div>-->
<!--                    <div class="nav__title_pic">-->
<!--                        <div class="nav__title_pict">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 48 48" fill="none">-->
<!--                                <path d="M20 6H8C7.46957 6 6.96086 6.21071 6.58579 6.58579C6.21071 6.96086 6 7.46957 6 8V20C6 20.5304 6.21071 21.0391 6.58579 21.4142C6.96086 21.7893 7.46957 22 8 22H20C20.5304 22 21.0391 21.7893 21.4142 21.4142C21.7893 21.0391 22 20.5304 22 20V8C22 7.46957 21.7893 6.96086 21.4142 6.58579C21.0391 6.21071 20.5304 6 20 6ZM40 26H28C27.4696 26 26.9609 26.2107 26.5858 26.5858C26.2107 26.9609 26 27.4696 26 28V40C26 40.5304 26.2107 41.0391 26.5858 41.4142C26.9609 41.7893 27.4696 42 28 42H40C40.5304 42 41.0391 41.7893 41.4142 41.4142C41.7893 41.0391 42 40.5304 42 40V28C42 27.4696 41.7893 26.9609 41.4142 26.5858C41.0391 26.2107 40.5304 26 40 26ZM34 6C29.588 6 26 9.588 26 14C26 18.412 29.588 22 34 22C38.412 22 42 18.412 42 14C42 9.588 38.412 6 34 6ZM14 26C9.588 26 6 29.588 6 34C6 38.412 9.588 42 14 42C18.412 42 22 38.412 22 34C22 29.588 18.412 26 14 26Z" fill="#7B30E6"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <span class="nav__title">Categories</span>-->
<!--                    </div>-->
<!--                    --><?php
//                    $terms = get_terms( 'categories', ['hide_empty' => false, 'meta_key' => 'menu', 'meta_value' => '1'] );
//                    if( $terms && ! is_wp_error( $terms ) ) {
//                        echo '<ul>';
//                        foreach( $terms as $term ) {
//                            echo '<li><a href="'.get_term_link( $term->term_id ).'">'. esc_html( $term->name );
//                        }
//                        echo '</ul>';
//                    }
//                    ?>
<!--                    <div class="nav__more">-->
<!--                        <a href="/categories" class="nav__more-link">More categories</a>-->
<!--                    </div>-->
<!--                    <div class="nav__title_pic">-->
<!--                        <div class="nav__title_pict">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 48 48" fill="none">-->
<!--                                <path d="M43.812 14.3391L39.5196 7.05469C39.136 6.40078 38.4548 6 37.7272 6H11.007C10.2795 6 9.59826 6.40078 9.21465 7.05469L4.92222 14.3391C2.70656 18.1008 4.6709 23.332 8.81121 23.9297C9.10883 23.9719 9.41307 23.993 9.71731 23.993C11.675 23.993 13.4079 23.0789 14.5984 21.6656C15.7889 23.0789 17.5283 23.993 19.4794 23.993C21.4372 23.993 23.17 23.0789 24.3605 21.6656C25.551 23.0789 27.2905 23.993 29.2416 23.993C31.1993 23.993 32.9321 23.0789 34.1226 21.6656C35.3198 23.0789 37.0526 23.993 39.0037 23.993C39.3146 23.993 39.6122 23.9719 39.9098 23.9297C44.0634 23.3391 46.0343 18.1078 43.812 14.3391ZM39.0169 26.25C38.3556 26.25 37.7008 26.1445 37.0658 25.9828V33H11.6684V25.9828C11.0335 26.1375 10.3787 26.25 9.71731 26.25C9.32048 26.25 8.91703 26.2219 8.52681 26.1656C8.15643 26.1094 7.79266 26.018 7.44213 25.9125V39.75C7.44213 40.9945 8.38791 42 9.55858 42H39.1889C40.3596 42 41.3054 40.9945 41.3054 39.75V25.9125C40.9482 26.025 40.5911 26.1164 40.2207 26.1656C39.8172 26.2219 39.4204 26.25 39.0169 26.25Z" fill="#7B30E6"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <span class="nav__title">Shops</span>-->
<!--                    </div>-->
<!--                    --><?php
//                    $terms = get_terms( 'categories-shops', ['hide_empty' => false, 'meta_key' => 'menu', 'meta_value' => '1'] );
//                    if( $terms && ! is_wp_error( $terms ) ) {
//                        echo '<ul>';
//                        foreach( $terms as $term ) {
//                            echo '<li><a href="'.get_term_link( $term->term_id ).'">'. esc_html( $term->name );
//                        }
//                        echo '</ul>';
//                    }
//                    ?>
<!--                    <div class="nav__more">-->
<!--                        <a href="/shops" class="nav__more-link">More shops</a>-->
<!--                    </div>-->
<!--                </nav>-->
            </div>
        </div>
        <div class="header__mobile">
            <div class="header__mobile-nav">
                <div class="header__mobile-item">
                    <a href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 20 20" fill="none">
                            <g clip-path="url(#clip0_3516_700)">
                                <path d="M12.7 17.1999V13.5997C12.7 13.1222 12.5104 12.6644 12.1728 12.3268C11.8352 11.9892 11.3774 11.7996 10.9 11.7996H9.1C8.62261 11.7996 8.16477 11.9892 7.82721 12.3268C7.48964 12.6644 7.3 13.1222 7.3 13.5997V17.1999C7.3 17.6773 7.11036 18.1352 6.77279 18.4728C6.43523 18.8103 5.97739 19 5.5 19H2.8C2.32261 19 1.86477 18.8103 1.52721 18.4728C1.18964 18.1352 1 17.6773 1 17.1999V8.55935C1.00017 8.28969 1.06091 8.02352 1.17775 7.78049C1.29458 7.53747 1.46451 7.32379 1.675 7.15526L8.875 1.3949C9.19425 1.13928 9.59103 1 10 1C10.409 1 10.8057 1.13928 11.125 1.3949L18.325 7.15526C18.5355 7.32379 18.7054 7.53747 18.8223 7.78049C18.9391 8.02352 18.9998 8.28969 19 8.55935V17.1999C19 17.6773 18.8104 18.1352 18.4728 18.4728C18.1352 18.8103 17.6774 19 17.2 19H14.5C14.0226 19 13.5648 18.8103 13.2272 18.4728C12.8896 18.1352 12.7 17.6773 12.7 17.1999Z" stroke="#A5ABB8" stroke-width="1.5" stroke-miterlimit="10"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_3516_700">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Home</span>
                    </a>
                </div>
                <!--<div class="header__mobile-item">
                    <a href="#" class="action__cat">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.24512 6.25C2.65933 6.25 2.99512 5.91421 2.99512 5.5C2.99512 5.08579 2.65933 4.75 2.24512 4.75C1.8309 4.75 1.49512 5.08579 1.49512 5.5C1.49512 5.91421 1.8309 6.25 2.24512 6.25Z" fill="#A0A4A8"/>
                        <rect x="5.99512" y="4.75" width="12.5107" height="1.5" rx="0.75" fill="#A0A4A8"/>
                        <path d="M2.24512 10.75C2.65933 10.75 2.99512 10.4142 2.99512 10C2.99512 9.58579 2.65933 9.25 2.24512 9.25C1.8309 9.25 1.49512 9.58579 1.49512 10C1.49512 10.4142 1.8309 10.75 2.24512 10.75Z" fill="#A0A4A8"/>
                        <rect x="5.99512" y="9.25" width="12.5107" height="1.5" rx="0.75" fill="#A0A4A8"/>
                        <path d="M2.24512 15.25C2.65933 15.25 2.99512 14.9142 2.99512 14.5C2.99512 14.0858 2.65933 13.75 2.24512 13.75C1.8309 13.75 1.49512 14.0858 1.49512 14.5C1.49512 14.9142 1.8309 15.25 2.24512 15.25Z" fill="#A0A4A8"/>
                        <rect x="5.99512" y="13.75" width="12.5107" height="1.5" rx="0.75" fill="#A0A4A8"/>
                        </svg>
                        <span>Menu</span>
                    </a>
                </div> -->
                <div class="header__mobile-item">
                    <a href="<?php the_permalink(51); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <rect x="1.5" y="2.5" width="7.09654" height="6.62027" rx="1.5" stroke="#7B30E6" stroke-width="1.5"/>
                            <rect x="1.5" y="10.9688" width="7.09654" height="6.62027" rx="1.5" stroke="#7B30E6" stroke-width="1.5"/>
                            <rect x="11.0312" y="10.9688" width="7.09654" height="6.62027" rx="1.5" stroke="#7B30E6" stroke-width="1.5"/>
                            <rect x="11.0312" y="2.5" width="7.09654" height="6.62027" rx="1.5" stroke="#7B30E6" stroke-width="1.5"/>
                        </svg>
                        <span>Best Deals</span>
                    </a>
                </div>
                <div class="header__mobile-item">
                    <a href="/categories">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                            <rect x="4.49219" y="14.4961" width="14.9988" height="1.2499" rx="0.624949" fill="#7B30E6"/>
                            <rect x="4.49219" y="9" width="14.9988" height="1.2499" rx="0.624949" fill="#7B30E6"/>
                            <rect x="4.49219" y="3.5" width="14.9988" height="1.2499" rx="0.624949" fill="#7B30E6"/>
                            <circle cx="1.99992" cy="3.99992" r="0.999918" fill="#7B30E6"/>
                            <circle cx="1.99992" cy="9.49601" r="0.999918" fill="#7B30E6"/>
                            <circle cx="1.99992" cy="14.9999" r="0.999918" fill="#7B30E6"/>
                        </svg>
                        <span>Categories</span>
                    </a>
                </div>
                <?php if( get_field('allowed_coupons', 'options') ): ?>
                <div class="header__mobile-item header__mobile-item_add">
                    <a href="#" class="btn">
                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 8.99799H8V13.998C8 14.2632 7.89464 14.5176 7.70711 14.7051C7.51957 14.8926 7.26522 14.998 7 14.998C6.73478 14.998 6.48043 14.8926 6.29289 14.7051C6.10536 14.5176 6 14.2632 6 13.998V8.99799H1C0.734784 8.99799 0.48043 8.89263 0.292893 8.70509C0.105357 8.51756 0 8.2632 0 7.99799C0 7.73277 0.105357 7.47842 0.292893 7.29088C0.48043 7.10334 0.734784 6.99799 1 6.99799H6V1.99799C6 1.73277 6.10536 1.47842 6.29289 1.29088C6.48043 1.10334 6.73478 0.997986 7 0.997986C7.26522 0.997986 7.51957 1.10334 7.70711 1.29088C7.89464 1.47842 8 1.73277 8 1.99799V6.99799H13C13.2652 6.99799 13.5196 7.10334 13.7071 7.29088C13.8946 7.47842 14 7.73277 14 7.99799C14 8.2632 13.8946 8.51756 13.7071 8.70509C13.5196 8.89263 13.2652 8.99799 13 8.99799Z" fill="white"/>
                        </svg>
                    </a>
                </div>
                <?php endif; ?>

                <div class="header__mobile-item">
                    <a href="/shops">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 20 20" fill="none">
                            <g clip-path="url(#clip0_3516_685)">
                                <path d="M16 1H4C2.34315 1 1 2.34315 1 4V16C1 17.6569 2.34315 19 4 19H16C17.6569 19 19 17.6569 19 16V4C19 2.34315 17.6569 1 16 1Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 5C14 7.21 12.21 9 10 9C7.79 9 6 7.21 6 5" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_3516_685">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Stores</span>
                    </a>
                </div>
<!--                <div class="header__mobile-item">-->
<!--                    <a href="/promocodes/promo">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 18 18" fill="none">-->
<!--                            <path d="M16.2474 5.33203V14.4987C16.2474 15.882 15.1866 16.9987 13.8724 16.9987H5.16406" stroke="#7B30E6" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>-->
<!--                            <path d="M11.5 2H3.58333C2.70888 2 2 2.74619 2 3.66667V12C2 12.9205 2.70888 13.6667 3.58333 13.6667H11.5C12.3745 13.6667 13.0833 12.9205 13.0833 12V3.66667C13.0833 2.74619 12.3745 2 11.5 2Z" stroke="#7B30E6" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>-->
<!--                        </svg>-->
<!--                        <span>Coupons</span>-->
<!--                    </a>-->
<!--                </div>-->
                <!-- <div class="header__mobile-item">
                    <?php if( is_user_logged_in() ): ?>
                    <a href="#" class="action__openuser">
                    <?php else: ?>
                    <a href="/registration">
                    <?php endif; ?>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512 14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014 3.3335 14.9493 3.3335 15.8333V17.5" stroke="#A0A4A8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238 11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889 9.16667 9.99984 9.16667Z" stroke="#A0A4A8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <span>Profile</span>
                    </a>
                    </a>
                </div> -->
            </div>
        </div>
    </header>