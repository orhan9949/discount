<div class="product__card views-click" product-id="<?php echo $post["ID"]; ?>" views-click="<?php echo $post["views_click"];?>">

    <div class="product__medium">
        <div class="beauty_border">
            <a href="#" class="action_fav" style="height: 20px; margin-top: 0; background:none" data-id="<?php echo $post["ID"]; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 12 14" fill="none">
                    <path d="M9.23333 12.84L6.1 10.1533C5.85333 9.94 5.48 9.94 5.23333 10.1533L2.1 12.84C1.66667 13.2133 1 12.9067 1 12.3333V1.66667C1 1.3 1.3 1 1.66667 1H9.66667C10.0333 1 10.3333 1.3 10.3333 1.66667V12.3333C10.3333 12.9 9.66667 13.2133 9.23333 12.84Z" stroke="#A5ABB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <a href="<?php echo $post["guid"]; ?>" class="product__card-a view_click" id="click_products">
            <?php if( $post["image_url"] ): ?>
                <img src="<?php echo $post["image_url"]; ?>" alt="<?php echo $post["post_title"] ?>" class="product__card-a__img">
            <?php endif; ?>
        </a>

    </div>
    <div class="product__desc">
        <div class="hidden_mobile">
            <div class="hidden_mobile">
                <div class="shop_icon">
                    <?php if($post["shop_name"]):?>
                        <a href="https://discount.one/categories-shops/<?php echo $post["shop_slug"] ?>">
                            <img src="<?php echo $post['shop_image_url']; ?>" class="product__card-shop_icon__img">
                            <span> | <?php echo $post["shop_name"];?></span>
                        </a>
                    <?php endif;?>
                </div>
            </div>
            <h2 class="product__title">
                <a href="<?php echo $post["guid"]; ?>" class="view_click" id="click_products">
                    <?php
                    if(strlen($post["post_title"]) > 30){
                        echo mb_substr( $post["post_title"], 0, 30 ). '...';
                    }else{
                        echo mb_substr( $post["post_title"], 0, 30 );
                    }
                    ?>
                </a>
            </h2>
<!--            <div class="content_card">-->
<!--                --><?php
//                if(strlen($post["post_content"]) > 30){
//                    echo mb_substr( $post["post_content"], 0, 30 ). '...';
//                }else{
//                    echo mb_substr( $post["post_content"], 0, 30 );
//                }
//                ?>
<!--            </div>-->
            <?php
            echo '<div class="product__price"><span style="text-decoration-line: line-through; margin-right: 10px">₹'.$post["old_price"].'</span><div class="product__price">₹'.$post["price"].' ('.$post["sale_size"].'%)</div></div>';
            ?>
        </div>
        <div class="hidden_pc">
            <?php
            echo '<div class="product__price"><span style="text-decoration-line: line-through; margin-right: 10px">₹'.$post["old_price"].'</span><div class="product__price">₹'.$post["price"].' ('.$post["sale_size"].'%)</div></div>';
            ?>
            <div class="product__published">Published <?php echo $post["post_date"]; ?></div>
            <div class="product__title">
                <a href="<?php echo $post["guid"]; ?>" class="view_click" id="click_products"><?php
                    if(strlen($post["post_title"]) > 30){
                        echo mb_substr( $post["post_title"], 0, 30 ). '...';
                    }else{
                        echo mb_substr( $post["post_title"], 0, 30 );
                    }
                    ?></a>
            </div>
            <div class="shop_icon">
                <?php if($post["shop_name"]):?>
                    <a href="https://discount.one/categories-shops/<?php echo $post["shop_slug"] ?>">
                        <img src="<?php echo $post['shop_image_url']; ?>" class="product__card-shop_icon__img">
                        <span> | <?php echo $post["shop_name"];?></span>
                    </a>
                <?php endif;?>
            </div>
        </div>
        <div class="product__buttons">
            <div class="" style="display: inline-flex; align-items: center">
                <div id="alert_promo__message"></div>
            </div>

            <div class="product__actions">


                <!--   этот див c классом data_analitics_click чисто для передачи данных для аналитики    -->
                <?php
                $term = get_term_by('slug', get_field('source', $post["ID"] ), 'categories-shops');
                $cat_post = get_the_terms( $post["ID"], 'categories' );
                $item_category = '';
                foreach($cat_post as $ct):
                    if($ct->parent == false): $item_category = $ct->name;
                    endif;
                endforeach;
                ?>
                <div
                    style="display:none;"
                    class="data_analitics_click"
                    item_id="<?php echo $post["ID"]; ?>"
                    new-price="<?php echo $post["price"]; ?>"
                    item_name="<?php echo $post["post_title"]; ?>"
                    affiliation="<?php echo $term->name; ?>"
                    item_brand="<?php echo $term->name; ?>"
                    item_category="<?php echo $item_category; ?>"
                    price="<?php echo $post["price"]; ?>"
                    quantity="1"
                    item_list_name="<?php echo htmlspecialchars($_COOKIE["item_list_name"]); ?>"
                >
                </div>
                <!--   КОНЕЦ    -->


                <?php if($post["promocode"] ): ?>
                    <a href="<?php echo $post["guid"] ?>" class="btn">Shop now</a>
                <?php elseif ( $link = $post["shop_link"]):?>
                    <a href="<?=$link ?>" target="_blank" class="btn" id="data_analitics">Shop now</a>
                <?php endif;?>
                <div class="product__author">
                    <?php if( $promocode = $post["promocode"] ): ?>
                        <div class="product__promocode">
                        <span style="display: none">
                        <?=$promocode ?>
                            </span>
                            <div class="socials">
                            <span data-val="<?=$promocode ?>" class="action_copy">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M10 2H3.33333C2.59695 2 2 2.59695 2 3.33333V10C2 10.7364 2.59695 11.3333 3.33333 11.3333H10C10.7364 11.3333 11.3333 10.7364 11.3333 10V3.33333C11.3333 2.59695 10.7364 2 10 2Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.9993 4.66663V12C13.9993 13.1066 13.106 14 11.9993 14H4.66602" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>