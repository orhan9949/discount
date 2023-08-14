<?php
$item = $args['item'];

$image = get_the_post_thumbnail_url($item->ID, 'meduim');
$price = get_field('price', $item->ID);
$amazon_asin = null;
$amazon_info = null;
if (0 && $amazon_asin = get_field('asin_code', $item->ID)) {
	$amazon_info = amazon_request($amazon_asin);
	$amazon_info = json_decode($amazon_info);
};


//var_dump($item[]);
?>
<div class="product__item views-click" product-id="<?php echo $item->ID; ?>" views-click="<?php echo $item->views_click; ?>">
    <div class="product__thumb">
         <!--<div class="product__rating" data-id="<?php echo $item->ID; ?>">
           <button type="button" class="product__rating-min">-</button>
            <span><?php echo get_field('rating', $item->ID); ?></span>
            <button type="button" class="product__rating-plus">+</button> 
        </div>-->
        <?php if( $image ): ?>
        <a href="<?php echo get_permalink($item->ID); ?>" class="view_click"><img src="<?php echo $image; ?>" alt="<?=$item->post_title; ?>"></a>
        <?php endif; ?>
        <!-- <?php if( $promocode = get_field('promocode') ): ?>
        <div class="product__promocode">
            <?=$promocode ?> 
            <span data-val="<?=$promocode ?>" class="action_copy"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M21,8.94a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.32.32,0,0,0-.09,0A.88.88,0,0,0,14.05,2H10A3,3,0,0,0,7,5V6H6A3,3,0,0,0,3,9V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V18h1a3,3,0,0,0,3-3V9S21,9,21,8.94ZM15,5.41,17.59,8H16a1,1,0,0,1-1-1ZM15,19a1,1,0,0,1-1,1H6a1,1,0,0,1-1-1V9A1,1,0,0,1,6,8H7v7a3,3,0,0,0,3,3h5Zm4-4a1,1,0,0,1-1,1H10a1,1,0,0,1-1-1V5a1,1,0,0,1,1-1h3V7a3,3,0,0,0,3,3h3Z" fill="#ffffff"/></svg></span>
        </div>
        <?php endif; ?> -->
    </div>
	<div style="margin-left: 10px;">
		<?php 
			if ($amazon_asin) {
				 $price = $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->DisplayAmount;
				 $old_price = $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Savings->Amount + $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Amount;
				 echo '<div class="product__price"><span style="text-decoration-line: line-through; margin-right: 10px">₹'.$old_price.'</span><div class="product__price">'.$price.'</div></div>';
			 }
			 
			 else {
				 echo dc_price($item->ID);  
			 }
		?> 
	</div>
    <div class="product__name_compact">
        <a href="<?php echo get_permalink($item->ID); ?>" class="view_click"><?php
				if($amazon_asin){
					echo ($amazon_info->SearchResult->Items[0]->ItemInfo->Title->DisplayValue);
				}
				else{
				echo $item->post_title;
				}
				?>
			 </a>
    </div>
	
	<div class="exp_time_compact">
        <div class= shop_icon_single_compact>
            <?php $term = get_term_by( 'slug', strtolower(get_field('source', $item->ID)), 'categories-shops' );
            $image = get_field('icon', 'categories-shops_'.$term->term_id);
            ?>
            <a href="../../categories-shops/<?php echo $term->slug ?>">
                <img src="<?php echo $image['url']; ?>"> | <?php echo $term->name;?>
            </a>
        </div>
		<?php 
		$expiration_date = get_field('expiration_date', $item->ID); ?>
		<?php if( $expiration_date ): ?>
        <div class="product__expires_compact"><span class="timer_expiers_compact">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M8.00001 2C9.1867 2 10.3467 2.35189 11.3334 3.01118C12.3201 3.67047 13.0892 4.60754 13.5433 5.7039C13.9974 6.80025 14.1162 8.00666 13.8847 9.17054C13.6532 10.3344 13.0818 11.4035 12.2427 12.2426C11.4035 13.0818 10.3344 13.6532 9.17056 13.8847C8.00667 14.1162 6.80027 13.9974 5.70391 13.5433C4.60756 13.0891 3.67049 12.3201 3.0112 11.3334C2.35191 10.3467 2.00001 9.18669 2.00001 8C1.99639 6.28088 2.65794 4.627 3.84617 3.38462" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 3.84618L3.84615 3.38464L4.30769 5.2308" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 4.76929V8.46159L10.4 9.66159" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
				</span><?php echo $expiration_date; ?></div>
        <?php endif; ?>
		
		</div>
	
</div>