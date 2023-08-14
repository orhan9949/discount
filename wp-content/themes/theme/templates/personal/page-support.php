<div class="account__content">
	<div class="support_page_block">
	<div class="account__content-left">
	<h1>
		Support Service
	</h1>
	<p>
		This is the section to contacting the support service in case of any problems or requests
	</p>
	<div>
		<p class="sup_title">
			Popular topics
		</p>
		<ul id="support_list">
		  <li id="supprt_list_elem">
			  <div id="support_title">How do I use a coupon code?</div>
			  <p class="disc_list_elem">
				  To use a coupon code, simply copy the code and paste it into the designated coupon code box during checkout on the retailer's website.
			  </p>
			</li>
			<li id="supprt_list_elem_2">
			  <div id="support_title">Can I use a coupon code more than once?</div>
			  <p class="disc_list_elem">
				  It depends on the terms and conditions of the offer. Some coupon codes can only be used once per user or per purchase, while others may have no limit on the number of times they can be used. Be sure to check the terms and conditions of each offer before redeeming it.
			  </p>
			</li>
			<li id="supprt_list_elem_3">
			  <div id="support_title">How often does your website update offers?</div>
			  <p class="disc_list_elem">
				  Every day — minumum 5 posts per day. It's a good idea to check us frequently to stay up-to-date on the latest deals and discounts.
			  </p>
			</li>
			<li id="supprt_list_elem_4">
			  <div id="support_title">Can I stack coupons?</div>
			  <p class="disc_list_elem">
				  It depends on the terms and conditions of each offer. Some retailers may allow users to stack coupons or promo codes, while others may only allow one offer per purchase. Be sure to check the terms and conditions of each offer before attempting to stack coupons.
			  </p>
			</li>
			<li id="supprt_list_elem_5">
			  <div id="support_title">How can I find the best deals?</div>
			  <p class="disc_list_elem">
				  You can search for coupons by store name, product category, or by browsing the site's featured coupons and deals. It's also a good idea to sign up for the site's email list to receive notifications of new coupons and deals.
			  </p>
			</li>
			<li id="supprt_list_elem_6">
			  <div id="support_title">Do coupon codes expire?</div>
			  <p class="disc_list_elem">
				  Yes, most coupon codes have expiration dates, so it's important to use them before they expire to ensure you receive the discount.
			  </p>
			</li>

		</ul>
	</div>	
	</div>
		<div class="aside_links_support">
	 <div class="footer_sup__menu">
                    <div class="footer_sup__title">Terms of Use</div>
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
			<div class="footer_sup__menu">
                    <div class="footer_sup__title">Social Media</div>
                    <ul >
                    <li><a href="<?php echo get_theme_mod('moj', '#'); ?>">Mojapp</a></li>
                    <li><a href="<?php echo get_theme_mod('telegram', '#'); ?>">Telegram</a></li>
                    <li><a href="<?php echo get_theme_mod('Josh', '#'); ?>">Josh</a></li>
                    <li><a href="<?php echo get_theme_mod('hipi', '#'); ?>">Hipi</a></li>
                    <li><a href="<?php echo get_theme_mod('sharechat', '#'); ?>">Share chat</a></li>
                </ul>
                </div>	
			
		</div>
				
	</div>
</div>