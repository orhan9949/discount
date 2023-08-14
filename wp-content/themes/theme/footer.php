<footer>
  <!--  <div class="footer__logo">
        <div class="container">
            <img src="<?php echo TEMPLATE_DIR_URI; ?>/images/logo-white.svg" alt="">
        </div>
    </div> -->
    <div class="container">
        <div class="footer__content">
            <div class="footer__left">
                <div class="footer__menu">
                    <div class="footer__title">Company</div>
                    <?php
                    if ( has_nav_menu( 'footer_1' ) ) {
                        wp_nav_menu(
                            array(
                                'container'  => false,
                                'menu_class'  => '',
                                'theme_location' => 'footer_1',
                            )
                        );
                    }
                    ?>
                </div>
               <!-- <div class="footer__menu">
                    <div class="footer__title">Community</div>
                    <?php
                    if ( has_nav_menu( 'footer_2' ) ) {
                        wp_nav_menu(
                            array(
                                'container'  => false,
                                'menu_class'  => '',
                                'theme_location' => 'footer_2',
                            )
                        );
                    }
                    ?>
                </div> -->
                <div class="footer__menu">
                    <div class="footer__title">Terms of Use</div>
                    <?php
                    if ( has_nav_menu( 'footer_3' ) ) {
                        wp_nav_menu(
                            array(
                                'container'  => false,
                                'menu_class'  => '',
                                'theme_location' => 'footer_3',
                            )
                        );
                    }
                    ?>
                </div>
                <div class="footer__menu">
                    <div class="footer__title">Download the app</div>
                    <a href="https://play.google.com/store/apps/details?id=com.digeltech.discountone" target="_blank" class="footer__gplay">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/gplay.png" alt="">
                    </a>
                </div>
            </div>
            <div class="footer__right">
                <p>Stay in touch</p>
                <ul class="socials">
                    <li><a href="<?php echo get_theme_mod('moj', '#'); ?>" target="_blank"><svg width="35" height="35" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path xmlns="http://www.w3.org/2000/svg" d="M9.81562 4.17229C9.76406 4.19104 9.65625 4.28479 9.57187 4.37854L9.42187 4.55197V6.89104V9.23479H7.11094C4.48594 9.23479 4.57031 9.22541 4.36875 9.60979L4.26562 9.81604V12.4645C4.26562 15.0238 4.27031 15.1176 4.35937 15.3004C4.59844 15.7832 5.15156 15.8395 5.50312 15.4223L5.625 15.2723V12.9332V10.5942H7.89844C10.3922 10.5942 10.3734 10.5942 10.6078 10.3176L10.7344 10.1629V7.82854V5.48947L13.0734 5.47541C15.3562 5.46135 15.4172 5.45666 15.5437 5.36291C15.9797 5.03947 15.9891 4.52385 15.5625 4.22854L15.4078 4.12541L12.6609 4.1301C11.1516 4.1301 9.87187 4.14885 9.81562 4.17229Z" fill="white"/>
						<path xmlns="http://www.w3.org/2000/svg" d="M17.7856 8.05781C17.6871 8.13281 15.4793 10.3219 12.8871 12.9188C9.07151 16.7438 8.15745 17.6813 8.11057 17.8266C8.00276 18.1734 8.17151 18.5578 8.49964 18.7031C8.69182 18.7922 8.86526 18.7969 13.5012 18.7969C18.0856 18.7969 18.3153 18.7922 18.4981 18.7078C18.6059 18.6609 18.7418 18.5484 18.8028 18.4641L18.9153 18.3047L18.9246 13.3828L18.9387 8.46094L18.8309 8.27813C18.6199 7.90781 18.1278 7.80469 17.7856 8.05781Z" fill="white"/>
                        </svg></a></li>
                    <li><a href="<?php echo get_theme_mod('telegram', '#'); ?>" target="_blank"><svg width="25" height="22" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.935228 8.60802L23.2272 0.17202C24.2522 -0.29398 25.1692 0.17202 24.7802 1.72602L21.1452 19.746C20.8652 21.02 20.1052 21.33 19.0322 20.74L13.2222 16.453C12.2973 17.3613 11.3653 18.2624 10.4262 19.156L10.3382 19.231C9.90723 19.595 9.72923 19.746 9.29223 19.746C8.84223 19.746 8.64023 19.466 8.37623 18.752L6.23223 12.196L0.655228 10.456C-0.244772 10.161 -0.276772 8.96502 0.935228 8.60802ZM19.8272 3.82302L7.13623 11.793L9.29523 18.41L9.83923 13.672L20.3702 4.19602C20.6502 3.87002 20.4482 3.40402 19.8262 3.82302H19.8272Z" fill="white"/>
                        </svg></a></li>
                    <li><a href="<?php echo get_theme_mod('Josh', '#'); ?>" target="_blank"><svg width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path xmlns="http://www.w3.org/2000/svg" d="M11.8252 4.38023L10.9448 5.89141L13.7307 5.95091L16.5045 6.0104L14.9247 8.41402C14.0684 9.74672 13.3568 10.8533 13.3568 10.889C13.3568 10.9247 13.8754 10.9485 14.5146 10.9485H15.6724L15.2985 11.3888C14.4664 12.3883 9.01516 17.7667 9.1237 17.493C9.184 17.3264 9.64229 16.2436 10.1488 15.0894C10.6553 13.9352 11.0654 12.9595 11.0654 12.9238C11.0654 12.8881 10.4986 12.8524 9.79907 12.8524C9.09958 12.8524 8.53275 12.8167 8.53275 12.7572C8.53275 12.7096 8.68953 12.3883 8.8825 12.0432L9.23224 11.4245H7.8815C5.95187 11.4245 6.00011 11.3769 6.00011 13.4354C6.00011 15.851 6.41016 16.9814 7.74884 18.2784C9.64229 20.1108 12.5367 20.5273 14.8523 19.3017C15.6603 18.8852 16.8663 17.6953 17.2523 16.9457C18 15.494 18 15.4821 18 9.15177C18 3.61869 17.9879 3.34501 17.7709 3.10702C17.5538 2.86904 17.4332 2.85714 15.1176 2.85714H12.6935L11.8252 4.38023Z" fill="white"/>
                        </svg></a></li>
                    <li><a href="<?php echo get_theme_mod('hipi', '#'); ?>" target="_blank"><svg width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path xmlns="http://www.w3.org/2000/svg" d="M4.81118 2.07255C4.02646 2.28082 3.40166 2.86471 3.11529 3.66802L3 3.98786V11.4446C3 17.5847 3.00744 18.9384 3.05207 19.1058C3.0781 19.2174 3.16736 19.4517 3.24918 19.6265C3.37191 19.8831 3.45744 20.0021 3.7215 20.2624C3.98183 20.5228 4.10084 20.612 4.35745 20.7347C4.66985 20.8835 5.11986 21.0025 5.37647 21.0025H5.51036L5.5178 13.4045C5.52895 6.11516 5.53267 5.80276 5.59962 5.60565C5.71491 5.25978 5.83764 5.05523 6.0645 4.82837C6.9236 3.96926 8.43353 4.19613 8.99883 5.25978C9.22197 5.68003 9.22941 5.76557 9.22941 8.16435V10.3288L9.55669 10.1652C10.9476 9.46602 12.677 9.28751 14.2501 9.68173C16.6861 10.2917 18.6312 12.2479 19.2523 14.7062C19.4419 15.4648 19.4568 15.7438 19.4568 18.481V21.0137L19.7432 20.9876C20.7659 20.8947 21.6138 20.1955 21.9002 19.2025L21.9858 18.9124V11.5041C21.9858 3.28496 22.0043 3.88373 21.7329 3.33703C21.532 2.92421 21.0709 2.47049 20.6469 2.26594C20.0556 1.97585 20.7362 1.99817 12.4836 2.00189C5.32441 2.00189 5.07523 2.00561 4.81118 2.07255Z" fill="white"/>
						<path xmlns="http://www.w3.org/2000/svg" d="M11.9192 13.1371C10.8518 13.3305 10.0038 13.9851 9.53152 14.9818C9.23772 15.5954 9.2526 15.4281 9.23772 18.3736L9.22656 21.0029H12.503H15.7795L15.7684 18.4442L15.7535 15.8892L15.6568 15.5322C15.2031 13.8698 13.589 12.8322 11.9192 13.1371Z" fill="white"/>
                        </svg></a></li>
                    <li><a href="<?php echo get_theme_mod('sharechat', '#'); ?>" target="_blank"><svg width="35" height="35" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path xmlns="http://www.w3.org/2000/svg" d="M11.672 3.17532C11.3891 3.26534 11.1447 3.39396 11.119 3.47112C11.0675 3.62546 12.135 4.42285 12.3922 4.42285C12.6752 4.42285 13.6012 3.41968 13.4469 3.26534C13.2411 3.05956 12.2122 3.00812 11.672 3.17532Z" fill="white"/>
						<path xmlns="http://www.w3.org/2000/svg" d="M14.3172 4.84822L13.6484 5.52986L15.3204 7.18895C16.2335 8.1021 16.9923 8.88663 16.9923 8.93808C16.9923 8.97666 16.2464 9.77406 15.3204 10.7001C14.4072 11.6261 13.6484 12.4492 13.6484 12.5264C13.6484 12.6164 14.3301 13.3752 15.1661 14.224C15.9892 15.06 16.6837 15.7931 16.7094 15.8445C16.7223 15.896 16.0663 16.6291 15.2561 17.4779C14.4458 18.3139 13.777 19.0727 13.777 19.1499C13.777 19.2913 15.4747 20.6289 15.6676 20.6289C15.912 20.6289 18.227 18.6097 19.1144 17.6194C20.2205 16.3976 21.3652 14.6099 21.6867 13.6196C22.2783 11.729 21.2237 9.46539 18.4714 6.66165C17.2882 5.46555 15.6033 4.16657 15.2432 4.16657C15.1018 4.16657 14.6902 4.47524 14.3172 4.84822Z" fill="white"/>
						<path xmlns="http://www.w3.org/2000/svg" d="M8.18153 5.14334C7.69281 5.54204 7.28125 5.94074 7.28125 6.04363C7.28125 6.21082 12.3228 11.3682 12.49 11.3682C12.5286 11.3682 13.0817 10.8537 13.6861 10.2235C14.4835 9.41326 14.7793 9.02743 14.7279 8.87309C14.4964 8.25575 9.80205 4.42312 9.2876 4.42312C9.17185 4.42312 8.68312 4.74465 8.18153 5.14334Z" fill="white"/>
						<path xmlns="http://www.w3.org/2000/svg" d="M5.1623 8.17924C4.73788 8.69369 4.39062 9.221 4.39062 9.34961C4.39062 9.87692 6.07544 12.0119 8.31329 14.314C10.0753 16.1275 12.1974 18.0566 12.4289 18.0566C12.5961 18.0566 14.7568 15.9088 14.6667 15.8188C13.5607 14.6356 6.11403 7.25323 6.04972 7.25323C5.98541 7.25323 5.58672 7.67765 5.1623 8.17924Z" fill="white"/>
						<path xmlns="http://www.w3.org/2000/svg" d="M3.11336 11.7159C2.869 12.5776 3.01047 13.4136 3.62781 14.5968C4.81104 16.9247 7.88487 20.0114 10.3028 21.3104C11.5503 21.9663 12.2191 22.1206 13.0808 21.9149C13.4666 21.8248 13.7753 21.6705 13.7753 21.5933C13.7753 21.5033 13.2094 20.976 12.5278 20.423C9.63399 18.0951 6.58588 15.0984 4.68243 12.732C4.06509 11.9603 3.48634 11.3044 3.39631 11.2786C3.30628 11.2401 3.19053 11.433 3.11336 11.7159Z" fill="white"/>
                        </svg></a></li>
                </ul>
                <div class="subscribe">
                    <div>Subscribe to our newsletter to receive special offers and discounts</div>
<!--                    <form action="">-->
<!--                        <input type="text" placeholder="Email">-->
<!--                        <button type="submit" class="btn">Subscribe</button>-->
<!--                    </form>-->
                </div>
				<?php echo do_shortcode('[mailpoet_form id="1"]'); ?>
                <ul class="footer__contact">
                    <li><a href="mailto:<?php echo get_theme_mod('email', ''); ?>"><?php echo get_theme_mod('email', ''); ?></a></li>
                    <li><a href="tel:<?php echo get_theme_mod('phone', ''); ?>"><?php echo get_theme_mod('phone', ''); ?> <span><?php echo get_theme_mod('timework', ''); ?></span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer__copyright">&copy; <?php echo date("Y"); ?> <?php echo get_theme_mod('copyright', ''); ?></div>
</footer>


	<!--<div id="center_alert">
		<div id="alert">
    		<div id="alert__close">&times;</div>
    		<div id="alert__message"></div>
		</div>
	</div> -->

		<div id="alert">
    		<div id="alert__close">&times;</div>
			<div class="h1_parody" id="alert__message" style="text-align: center;"class="ad_re_deal"></div>
		</div>

	 <div id="center_alert_authorization">
		<div id="alert_authorization">
    		<div id="alert_authorization__close">&times;</div>

            <div class="reg">
                <div class="reg__block">
                    <img src="https://discount.one/?attachment_id=105" alt="" class="img_push">
                    <div class="reg__form">
                        <div class="tabs_push tabs-js">
                            <div class="tabs__active"><a href="#">My account</a></div>
                            <ul>
                                <li class="active"data-tab="login"><a href="#">My account</a></li>
                                <li data-tab="reg"><a href="#">New account</a></li>
                            </ul>
                        </div>
                        <div id="login" class="tab-content_push active">
                            <div class="title_push" >Please Log In or Sign Up!</div>
                            <p class="under_title_push">
                                If you want to add product to your favorites
                            </p>
                            <form id="login-form">
                                <div class="field"><input type="text" name="login" placeholder="Email"></div>
                                <div class="field"><input type="password" name="password" placeholder="Password"></div>
                                <div class="field">
                                    <button class="btn" type="submit">Log In</button>
                                    <a href="/registration" class="btn" style="background: #ffffff;color: #8F00FF;text-decoration: underline;">Sign Up</a>
                                </div>
                            </form>
                        </div>

                        <div id="reg" class="tab-content_push">
                            <div class="title_push">Authorization required</div>
                            <p class="under_title_push">

                            </p>
                            <form id="reg-form">
                                <div class="field"><input type="text" name="login" placeholder="Your name"></div>
                                <div class="field">
                                    <input type="text" name="email" placeholder="Email">
                                </div>

                                <div class="field">
                                    <input type="password" name="password" placeholder="Password">
                                    <small>We will send you an email to confirm your registration.</small>
                                </div>

                                <div class="field">
                                    <button class="btn" type="submit">Sign Up</button>
                                    <small>By clicking on the "Sign Up" button, you agree <a href="/privacy-policy">with the personal data processing policy and the rules for using the service.</a></small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
				
			
		</div>
	</div>



	<!-- <div id="center_alert_authorization">
		<div id="alert_authorization">
    		<div id="alert_authorization__close">&times;</div>
			<div style="display: flex; justify-content: center; flex-wrap: wrap;">
			<svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" viewBox="0 0 140 140" fill="none">
<rect opacity="0.1" width="140" height="140" rx="10" fill="#9449FF"/>
<path d="M64.3767 17C49.8326 17 38 28.2752 38 42.1342V52H49.093V42.1342C49.093 33.9128 55.9953 27.5705 64.6233 27.5705C73.2512 27.5705 79.907 34.1476 79.907 42.1342V52H91V42.1342C91 28.2752 79.1674 17 64.3767 17Z" fill="#D3B4FF"/>
<path d="M64.3767 18C49.8326 18 38 29.2752 38 43.1342V53H49.093V43.1342C49.093 34.9128 55.9953 28.5705 64.6233 28.5705C73.2512 28.5705 79.907 35.1477 79.907 43.1342V53H91V43.1342C91 29.2752 79.1674 18 64.3767 18Z" fill="#D3B4FF"/>
<path d="M90.6909 105H38.3091C34.1673 105 31 101.927 31 97.9091V60.0909C31 56.0727 34.1673 53 38.3091 53H90.6909C94.8327 53 98 56.0727 98 60.0909V97.9091C98 101.691 94.5891 105 90.6909 105Z" fill="#AF77FF"/>
<path d="M90.6909 53H38.3091C34.1673 53 31 55.9714 31 59.8571V69C31 65.1143 34.1673 62.1429 38.3091 62.1429H90.6909C94.8327 62.1429 98 65.1143 98 69V59.8571C98 55.9714 94.5891 53 90.6909 53Z" fill="#8A37FF"/>
<path d="M123.697 71.1495C116.587 64.2835 104.817 64.2835 97.7068 71.1495C92.0674 76.595 90.8414 84.6449 94.0289 91.2741L70.7356 114.003C70.2452 114.477 70 115.187 70 115.897L70.4904 120.396C70.7356 121.579 71.4712 122.29 72.6971 122.526L77.3558 123C78.0914 123 78.827 122.763 79.3173 122.29L82.0145 119.685C82.5049 119.212 82.75 118.738 82.75 118.028V115.66H85.202C85.9376 115.66 86.4279 115.424 86.9183 114.95L89.1251 112.819C89.6155 112.346 89.8606 111.872 89.8606 111.162V109.741C89.8606 109.031 90.1058 108.558 90.5962 108.084L93.5385 105.243C94.0289 104.769 94.5193 104.533 95.2549 104.533H96.7261C97.4616 104.533 97.952 104.296 98.4424 103.822L102.611 99.7975C109.476 102.875 117.813 101.692 123.452 96.2461C130.808 89.3801 130.808 78.0156 123.697 71.1495ZM115.116 79.4361C113.644 78.0156 113.644 75.8847 115.116 74.4642C116.587 73.0436 118.793 73.0436 120.265 74.4642C121.736 75.8847 121.736 78.0156 120.265 79.4361C118.793 80.8567 116.587 80.8567 115.116 79.4361Z" fill="#8A37FF"/>
<path d="M97.7037 78.4557C102.608 73.6917 109.475 72.2625 115.605 73.9299C117.077 72.9771 119.039 72.9771 120.265 74.4063C121 75.1209 121.246 75.8355 121.246 76.5501C122.227 77.0265 122.962 77.7411 123.698 78.4557C126.395 81.0759 127.867 84.1726 128.602 87.2692C129.829 81.5523 128.112 75.3591 123.698 70.8332C116.586 63.9254 104.815 63.9254 97.7037 70.8332C93.0444 75.3591 91.573 81.5523 92.7991 87.2692C93.5348 83.9344 95.2514 80.8377 97.7037 78.4557Z" fill="#D3B4FF"/>
<path d="M70.9731 121.332L94.2698 98.7031C93.2889 96.7975 92.7984 94.8919 92.5532 92.748L70.7279 113.948C70.2374 114.424 69.9922 115.139 69.9922 115.854L70.4826 120.38C70.7279 120.618 70.7279 120.856 70.9731 121.332Z" fill="#D3B4FF"/>
<rect x="51" y="70" width="28" height="4" rx="2" fill="#D3B4FF"/>
<rect x="51" y="77" width="28" height="3" rx="1.5" fill="#D3B4FF"/>
<rect x="51" y="83" width="28" height="3" rx="1.5" fill="#D3B4FF"/>
</svg>
			
				<h1 id="alert_authorization__message" style="width: 500px; text-align: center; margin-top: 10px;"></h1>
				<div style="color: #787597; text-align: center; margin-bottom: 20px;">
					To receive notifications about discounts, leave a rating for our coupons, save your favorite discounts and much more, you need to log in to our website
				</div>
				<div class="header__user-signup"><a href="/registration">Sign in</a></div>
			</div>
		</div>
	</div> -->
<?php wp_footer(); ?>
</body>
</html>