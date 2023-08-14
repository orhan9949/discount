<?php
/**
 * Auto Amazon Links
 *
 * Generates links of Amazon products just coming out today. You just pick categories and they appear even in JavaScript disabled browsers.
 *
 * https://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2022 Michael Uno
 */

/**
 * Available variables.
 * @var AmazonAutoLinks_Option $oOption
 * @var array $aOptions the plugin options @deprecated use $oOption
 * @var array $aProducts the fetched product links
 * @var array $aArguments the user defined unit arguments such as image size and count etc.
 */
<?php
$image = get_the_post_thumbnail_url(get_the_ID(), 'meduim');
$expiration_date = get_field('expiration_date');
?>

<div class="product__card">
    <div class="product__medium">
        
        <div class="beauty_border">
        <a href="#" class="action_fav" style="height: 25px; margin-top: 10px;" data-id="<?php echo get_the_ID(); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 12 14" fill="none">
<path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                </a>
</div>
        <!--<div class="product__rating" data-id="<?php echo get_the_ID(); ?>">
            <button type="button" class="product__rating-min">-</button>
            <span><?php echo get_field('rating'); ?></span>
            <button type="button" class="product__rating-plus">+</button>
        </div> -->
        <a href="<?php the_permalink(); ?>">
            <?php if( $image ): ?>
            <img src="<?php echo $image; ?>" alt="<?php echo get_the_title() ?>">
            <?php endif; ?>
        </a>
    </div>
    <div class="product__desc">
        
        <!--<div class="product__rating_out" data-id="<?php echo get_the_ID(); ?>">
            <div class="arrows_raiting">
                               
                <div class="arrow_mobile_k"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 8 3" fill="none">
<path d="M3.74182 0.120897C3.87962 -0.0402993 4.12038 -0.040299 4.25818 0.120898L7.91077 4.39372C8.11093 4.62786 7.95245 5 7.65259 5H0.347407C0.0475472 5 -0.110926 4.62786 0.0892264 4.39372L3.74182 0.120897Z" fill="#A5ABB8"/>
</svg>
                    </div>
                <div class="arrow_mobile_k">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 8 7" fill="none">
<path d="M3.74182 4.8791C3.87962 5.0403 4.12038 5.0403 4.25818 4.8791L7.91077 0.606277C8.11093 0.372138 7.95245 6.0837e-08 7.65259 6.0837e-08H0.347407C0.0475472 6.0837e-08 -0.110926 0.372138 0.0892264 0.606278L3.74182 4.8791Z" fill="#A5ABB8"/>
</svg>
                    </div>
                </div>
                                      <span><?php the_field('rating'); ?></span> 
                            </div> -->
        
        <?php if( $expiration_date ): ?>
        <div class="product__expires"> <!-- <span style="margin-right: 5px;"><?php the_field('rating'); ?></span> --> <span class="timer_expiers"> 
            
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
<path d="M8.00001 2C9.1867 2 10.3467 2.35189 11.3334 3.01118C12.3201 3.67047 13.0892 4.60754 13.5433 5.7039C13.9974 6.80025 14.1162 8.00666 13.8847 9.17054C13.6532 10.3344 13.0818 11.4035 12.2427 12.2426C11.4035 13.0818 10.3344 13.6532 9.17056 13.8847C8.00667 14.1162 6.80027 13.9974 5.70391 13.5433C4.60756 13.0891 3.67049 12.3201 3.0112 11.3334C2.35191 10.3467 2.00001 9.18669 2.00001 8C1.99639 6.28088 2.65794 4.627 3.84617 3.38462" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2 3.84618L3.84615 3.38464L4.30769 5.2308" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8 4.76929V8.46159L10.4 9.66159" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                </span><?php echo $expiration_date; ?></div>
        <?php endif; ?>
       
         <div class="hidden_mobile">
             <div class="product__published">Published <?php echo dc_passed(get_the_date("Y-m-d H:i:s")); ?></div>
             <div class="product__title">
            <a href="<?php the_permalink(); ?>"><?php echo get_the_title() ?></a>
        </div>
             <div class="content_card">
                 <?php the_content(); ?>
            </div>
            
             
        
       <!-- <?php echo dc_price(get_the_ID()); ?> -->
        </div>
        
        <div class="hidden_pc">
            <!-- <?php echo dc_price(get_the_ID()); ?> -->
            <div class="product__published">Published <?php echo dc_passed(get_the_date("Y-m-d H:i:s")); ?></div>
            <div class="product__title">
            <a href="<?php the_permalink(); ?>"><?php echo get_the_title() ?></a>
        </div>

            <!--<div class="shop_icon">
                <?php 
                    $term = get_term_by( 'name', get_field('source'), 'categories_shops' );
                    $image = get_field('icon', 'categories_shops_'.$term->term_id)
                ?> 
                <a href="https://discount.one/categories-shops/<?php echo $term->slug ?>">
                    <img src="<?php echo $image['url']; ?>"; class="shop_icon">
                </a>    
            </div> -->

        </div>
        
        
        
        
        <div class="product__buttons">
            <div class="hidden_mobile">
            <!--<div class="shop_icon">
                <?php 
                    $term = get_term_by( 'name', get_field('source'), 'categories_shops' );
                    $image = get_field('icon', 'categories_shops_'.$term->term_id)
                ?> 
                <a href="https://discount.one/categories_shops/<?php echo $term->slug ?>">
                    <img src="<?php echo $image['url']; ?>";>
                </a>    
            </div> -->
            </div>

    
            <div class=""style="display: inline-flex; align-items: center">
                <h1 id="alert_promo__message"></h1>
            </div>
            <!-- <div class="product__author">
                  <?php if( $promocode = get_field('promocode') ): ?>
                <div class="product__promocode">
                    <span style="display: none">
                    <?=$promocode ?> 
                        </span>
                    <div class="socials">
                    <span data-val="<?=$promocode ?>" class="action_copy"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
<path d="M10 2H3.33333C2.59695 2 2 2.59695 2 3.33333V10C2 10.7364 2.59695 11.3333 3.33333 11.3333H10C10.7364 11.3333 11.3333 10.7364 11.3333 10V3.33333C11.3333 2.59695 10.7364 2 10 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.9993 4.66663V12C13.9993 13.1066 13.106 14 11.9993 14H4.66602" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span>
                    </div>
                    </div>

    
                <?php if(0): ?>
                <div class="account__pill-picture">
                    <?php echo get_avatar(get_the_author_ID(), 50); ?>
                </div>
                <div class="account__pill-name"><?php echo get_the_author(); ?></div>
                <?php endif; ?>
           
                            <?php endif; ?>
             </div> -->
            <div class="product__actions">
                <!-- <a href="#" class="btn btn-border"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V9C18 7.9 17.1 7 16 7H8C6.9 7 6 7.9 6 9V19ZM18 4H15.5L14.79 3.29C14.61 3.11 14.35 3 14.09 3H9.91C9.65 3 9.39 3.11 9.21 3.29L8.5 4H6C5.45 4 5 4.45 5 5C5 5.55 5.45 6 6 6H18C18.55 6 19 5.55 19 5C19 4.45 18.55 4 18 4Z" fill="#A3A3A3"/></svg></a> -->
                
                <!-- <?php if( $link = get_field('link') ): ?>
                <a href="<?=$link ?>" target="_blank" class="btn">SEE MORE</a>
                <?php endif; ?> -->
                
                 <?php if(get_field('promocode') ): ?>
                 <a href="<? the_permalink() ?>" class="btn">SEE MORE</a>
                <?php elseif ( $link = get_field('link')):?>
                <a href="<?=$link ?>" target="_blank" class="btn">SEE MORE</a>
                <?php endif;?>
                
                <div class="product__author">
                  <?php if( $promocode = get_field('promocode') ): ?>
                <div class="product__promocode">
                    <span style="display: none">
                    <?=$promocode ?> 
                        </span>
                    <div class="socials">
                    <span data-val="<?=$promocode ?>" class="action_copy"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
<path d="M10 2H3.33333C2.59695 2 2 2.59695 2 3.33333V10C2 10.7364 2.59695 11.3333 3.33333 11.3333H10C10.7364 11.3333 11.3333 10.7364 11.3333 10V3.33333C11.3333 2.59695 10.7364 2 10 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.9993 4.66663V12C13.9993 13.1066 13.106 14 11.9993 14H4.66602" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span>
                    </div>
                    </div>


           
                            <?php endif; ?>
             </div>
                
                <!--<a href="#" class="btn btn-border action_fav" data-id="<?php echo get_the_ID(); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 14" fill="none">
<path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                </a> -->
               <!-- <a href="<?php the_permalink(); ?>#comments" class="btn btn-border">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.3 21.3L18 19H4C3.45 19 2.97933 18.8043 2.588 18.413C2.196 18.021 2 17.55 2 17V5C2 4.45 2.196 3.979 2.588 3.587C2.97933 3.19567 3.45 3 4 3H20C20.55 3 21.021 3.19567 21.413 3.587C21.8043 3.979 22 4.45 22 5V20.575C22 21.025 21.796 21.3373 21.388 21.512C20.9793 21.6873 20.6167 21.6167 20.3 21.3Z" fill="#404040"/></svg> <span><?php echo wp_count_comments(get_the_ID())->approved; ?></span>
                </a> -->
               
            </div>
        </div>
    </div>
</div>  