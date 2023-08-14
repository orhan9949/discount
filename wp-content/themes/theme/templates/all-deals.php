<?php
/**
 * Template Name: All Deals
 */

get_header();
?>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>
<main class="container">
    <section>
<!--        <div>-->
<!--            --><?php
//
//            echo do_shortcode('[contact-form-7 id="2657" title="Contact form 1"]');
//
//            ?>
<!--        </div>-->
<?php
//        $cat_arr = [
//            1  => 1,
//            2  => 13,
//            3  => 55,
//            4  => 190,
//            5  => 3,
//            6  => 6,
//            7  => 19,
//            8  => 5,
//            9  => 10,
//            10 => 45,
//            11 => 93,
//            12 => 15,
//            13 => 116,
//            14 => 88,
//            15 => 57,
//            16 => 16,
//            17 => 56,
//            18 => 112,
//            19 => 11,
//            20 => 14,
//            21 => 54,
//            22 => 425,
//            23 => 453,
//            24 => 461,
//            25 => 462,
//            26 => 460,
//            27 => 434,
//            28 => 469,
//            29 => 464,
//            30 => 474,
//            31 => 470,
//            32 => 448,
//            33 => 427,
//            34 => 429,
//            35 => 431,
//            36 => 432,
//            37 => 386,
//            38 => 476,
//            39 => 477,
//            40 => 478,
//            41 => 435,
//            42 => 412,
//            43 => 479,
//            44 => 444,
//            45 => 480,
//            46 => 481,
//            47 => 430,
//            48 => 428,
//            49 => 442,
//            50 => 445,
//            51 => 433,
//            52 => 409,
//            53 => 437,
//            54 => 387,
//            55 => 388,
//            56 => 389,
//            57 => 390,
//            58 => 3,
//            59 => 3,
//            60 => 389,
//            61 => 384,
//            62 => 385,
//            63 => 383,
//            64 => 503,
//            65 => 507,
//            66 => 391,
//            67 => 502,
//            68 => 382,
//            69 => 3,
//            70 => 369,
//            71 => 394,
//            72 => 518,
//            73 => 380,
//            74 => 392,
//            75 => 3,
//            76 => 381,
//            77 => 370,
//            78 => 447,
//            79 => 413,
//            80 => 419,
//            81 => 420,
//            82 => 463,
//            83 => 401,
//            84 => 411,
//            85 => 416,
//            86 => 410,
//            87 => 418,
//            88 => 396,
//            89 => 446,
//            90 => 450,
//            91 => 415,
//            92 => 421,
//            93 => 398,
//            94 => 403,
//            95 => 439,
//            96 => 423,
//            97 => 422,
//            98 => 3,
//            99 => 404,
//            100 => 405,
//            101 => 484,
//            102 => 486,
//            103 => 414,
//            104 => 10,
//            105 => 508,
//            106 => 471,
//            107 => 438,
//            108 => 435,
//            109 => 468,
//            110 => 467,
//            111 => 452,
//            112 => 473,
//            113 => 377,
//            114 => 379,
//            115 => 449,
//            116 => 440,
//            117 => 441,
//            118 => 426,
//            119 => 515,
//            120 => 443,
//            121 => 456,
//            122 => 423,
//            123 => 388,
//            124 => 424,
//            125 => 487,
//            126 => 406,
//            127 => 399,
//            128 => 400,
//            129 => 402,
//            130 => 378,
//            131 => 374,
//            132 => 373,
//            133 => 397,
//            134 => 408,
//            135 => 436,
//            136 => 55,
//            137 => 377,
//            138 => 459,
//            139 => 458,
//            140 => 455,
//            141 => 475,
//            142 => 457,
//            143 => 466,
//            144 => 465,
//            145 => 367,
//            146 => 512,
//            147 => 513,
//            148 => 514,
//            149 => 516,
//            150 => 393,
//            151 => 504,
//            152 => 509,
//            153 => 507,
//            154 => 483,
//            155 => 493,
//            156 => 501,
//            157 => 395,
//            158 => 511,
//            159 => 16,
//            160 => 489,
//            161 => 482,
//            162 => 491,
//            163 => 405,
//            164 => 490,
//            165 => 494,
//            166 => 371,
//            167 => 451,
//            168 => 506,
//            169 => 485,
//            170 => 3,
//            171 => 463,
//            173 => 11
//        ];
//
//                $shops_id_admitad = [
//                    "ajio"           => 15591,
//                    "myntra"         => 15481,
//                    "snapdeal"       => 27814,
//                    "croma"          => 17685,
//                    "nykaa"          => 15667,
//                    "puma"          => 21567,
//                    "libas"         => 25931
//                ];
//
//                $shops_id = [
//                    "ajio"           => 137,
//                    "myntra"         => 138,
//                    "snapdeal"       => 204,
//                    "croma"          => 134,
//                    "nykaa"          => 144,
//                    "puma"          => 350,
//                    "libas"         => 352
//                ];
//
//
//
//                $access_token ='5HIyjhE9qE9JfWlN6jCJttdLCyyFuF';
//
//                $from = 302;
                //$tmp = get_terms( array( 'taxonomy' => 'categories', 'parent' => 0 ) );
                //sub_categories_adder(126900, $cat_arr);

//parse_update_shops();
//                $body = parser_request_ids("519099");
//                var_dump($body);
                //parse_inf_staff_shops($cat_arr);

                //var_dump($tmp);
                //twenty_deleter();
                //$body = parser_request($from, "amazon");
                //$body = parser_request(1, "themancompany");
                //sub_cat_adder($body->items, $cat_arr);
                //sub_categories_adder(0, $cat_arr);
                //parse_inf_staff($cat_arr);
//                $itm = $body->items[0]->categories[0]->isMain;
//                if (!$itm) {
//                    print_r($body->items[0]->categories[0]->category->id);
//                }
//                else {
//                  print_r($body->items[0]->categories[1]->category->id);
//                };
                //print_r($itm."\n");
                //amazon_desc_add($body->items);
//parse_inf_staff_shops();
                //amazon_desc_add($items);

//admitad_authorization();
//parse_inf_staff_shops();
//pars_cat_adder();
                //page_post_parse_amazon("amazon", $cat_arr, 133, 3960);
        //		$id = 15591;
        //		$cat = "croma";
        //        //$body = parser_request("1", $cat);
        //        //$cat_id = $cat_arr[$body->items[7]->categoryId];
        //        //add_post_pars_amazon($body->items[7], "amazon", 133, $cat_id);
        //        $shop = "ajio";
        //        //page_post_parse($access_token, $shops_id_admitad[$shop], $shop,$shops_id[$shop]);
        //        $tmp = 1;
        //        var_dump($tmp);
        //
        //        //$tmp = add_post_pars($body->items[7], $access_token, $shops_id_admitad[$cat], $cat, $shops_id[$cat], $cat_id);
        //        //var_dump($tmp);
        //		//echo $i.") ".$good_url." – ";
        //// 		$body = parser_request("1", $cat);
        //// 		$tmp = $cat_arr[$body->items[3]->categoryId];
        //// 		print_r($tmp);
        //// 		print_r($body);
        //		//$tmp = admitad_authorization();
        //		//print_r($tmp);
        //        //$tmp = admitad_authorization();
        //        //var_dump($tmp);
        //		//add_post_pars($body->items[3], $access_token, $id, "ajio", 137, $tmp);
        //		/*for ($i = 23; $i <= 23; $i++) {
        //			//$good_url = substr($body->items[$i]->url, 8);
        //			//$title = $body->items[$i]->title;
        //			// = $body->items[$i]->description;
        //			//add_post_pars($body->items[$i], $access_token, $id, $cat);
        //			//print_r($body->items[$i]);
        //// 			$tmp_url = admitad_get_deeplink($access_token, $id, $body->items[$i]->url);
        //// 			echo "======".$tmp_url[0]."=====";\
        //// 			var_dump(admitad_make_short_link($tmp_url[0], $access_token));
        //// 			//var_dump(json_decode(admitad_make_short_link($tmp_url[0], $access_token))->short_link);
        //			//print_r( _get_cron_array() );
        //		} */
//        		?>

        <?php


//pars_id_adder();
//twenty_deleter();
//pars_cat_adder();
//pars_id_adder();
//        require get_template_directory() .'/array-page/categories/page-categories.php';
//        require get_template_directory() .'/array-page/categories/categories.php';
//      require get_template_directory() .'/array-page/best-deals/best-deals.php';
//     require get_template_directory() .'/array-page/home/home.php';
//     require get_template_directory() .'/array-page/home/home-mob.php';
//$another_deals = get_field("another_deals", 6);
//foreach ($another_deals as $i => $another_d){
//    echo $i. ') ' .$another_d. '<br>';
//}


//                require get_template_directory() .'/array-page/single-page/single-page.php';
//      home_array();
//        $tmp = get_option( 'cron' );
//        var_dump($tmp);
        //image_loader(0, "https://asset1.cxnmarksandspencer.com/is/image/mands/OD_01_T49_5050K_Y0_X_EC_0");
        //admitad_authorization();
//parse_update_shops();
//        require get_template_directory() .'/array-page/categories-shops/top-deals.php';
//require get_template_directory() .'/array-page/categories-shops/categories-shops.php';
//       require get_template_directory() .'/array-page/categories/categories.php';

//  require get_template_directory() .'/setting-pages/hidden-shops/hidden-shops.php';
        ?>
    </section>
</main>
<?php get_footer(); ?>