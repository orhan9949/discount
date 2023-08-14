<?php
$item = $args['item'];


?>
<div class="product__item views-click" product-id="<?php echo $item['ID']; ?>" views-click="<?php echo $item['views_click']; ?>">
    <div class="product__thumb">
        <?php if( $item['image_url'] ): ?>
        <a href="<?php echo $item['permalink']; ?>" class="view_click" id="click_products">
            <img src="<?php echo $item['image_url']; ?>" alt="<?=$item['post_title']; ?>">
        </a>
        <?php endif; ?>
    </div>
	<div style="margin-left: 10px;">
            <div class="product__price">
                <span style="text-decoration-line: line-through; margin-right: 10px">₹ <?php echo $item['old_price']; ?></span>
                ₹ <?php echo $item['price'].' ('.$item['sale_size'] .'%)' ;?>
            </div>
	</div>
    <div class="product__name_compact">
        <a href="<?php echo $item['permalink']; ?>" class="view_click" id="click_products">
            <?php echo $item['post_title']; ?>
        </a>
    </div>
	
	<div class="exp_time_compact">
        <div class= shop_icon_single_compact>
            <a href="<?php echo $item['shop_url'] ?>">
                <img src="<?php echo $item['shop_image_url']; ?>"> | <?php echo $item['shop_name'];?>
            </a>
        </div>
		<?php $expiration_date = $item['expiration_date'];
        if( $expiration_date ): ?>
            <div class="product__expires_compact">
                <span class="timer_expiers_compact">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M8.00001 2C9.1867 2 10.3467 2.35189 11.3334 3.01118C12.3201 3.67047 13.0892 4.60754 13.5433 5.7039C13.9974 6.80025 14.1162 8.00666 13.8847 9.17054C13.6532 10.3344 13.0818 11.4035 12.2427 12.2426C11.4035 13.0818 10.3344 13.6532 9.17056 13.8847C8.00667 14.1162 6.80027 13.9974 5.70391 13.5433C4.60756 13.0891 3.67049 12.3201 3.0112 11.3334C2.35191 10.3467 2.00001 9.18669 2.00001 8C1.99639 6.28088 2.65794 4.627 3.84617 3.38462" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 3.84618L3.84615 3.38464L4.30769 5.2308" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 4.76929V8.46159L10.4 9.66159" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span><?php echo $expiration_date; ?>
            </div>
        <?php endif; ?>
		</div>
</div>