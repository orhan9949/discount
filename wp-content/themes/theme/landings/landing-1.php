<?php
/**
 * Template Name: Landing-1
 */



get_header();
?>

<style>
html {
  scroll-behavior: smooth; /* свойство scroll-behavior не наследуется, применяется к прокручиваемым блокам */ 
}
</style>

<body>
   <!-- Секция с заголовком и начальной титульной картинкой -->
   <div class="tilte_prev">
      <div class="sec_left">
      <div class="title_prev_text">
         Register now and start saving
      </div>
      <p class="title_text">
         Get access to the best deals and thousands of coupons from your favorite brands
      </p>
      <div class="reg_btn_lan">
         <a href="#reg_anchor" class="btn">
         Register
      </a>
      </div>
      
      </div>

      <div class="sec_right">
        <img src="https://discount.one/wp-content/uploads/2023/03/frame-810-1.png" alt=""> 
      </div> 
   </div>

   <!-- Секция с плашками с приемуществами регистрации -->
   <div class="adv_sec">
      <div class="sec_title">
         Benefits of Registering
      </div>
      <div class="tiles_adv">
         <div class="tile_single">
            <img src="https://discount.one/wp-content/uploads/2023/03/label_account_tag_icon_250749_1.svg" alt="" class="tile_img"> 
            <p class="tile_text">
               Get exclusive offers and discounts on our website
            </p>
         </div>

         <div class="tile_single">
            <img src="https://discount.one/wp-content/uploads/2023/03/post_feed_image_icon_250754_1.svg" alt="" class="tile_img"> 
            <p class="tile_text">
               Ability to rate and influence products
            </p>
         </div>

         <div class="tile_single">
            <img src="https://discount.one/wp-content/uploads/2023/03/mark_save_bookmark_icon_250741_1.svg" alt="" class="tile_img"> 
            <p class="tile_text">
               Save and organize favorite coupons for later use
            </p>
         </div>

         <div class="tile_single">
            <img src="https://discount.one/wp-content/uploads/2023/03/message_alert_bell_count_notification_icon_250752_1.svg" alt="" class="tile_img"> 
            <p class="tile_text">
               Find important promotions, discounts, and sales notifications in the website's notification section
            </p>
         </div>

         <div class="tile_single">
            <img src="https://discount.one/wp-content/uploads/2023/03/messages_envelope_letter_icon_250758_1.svg" alt="" class="tile_img"> 
            <p class="tile_text">
               Subscribe to receive email notifications and customize them
            </p>
         </div>

         <div class="tile_single">
            <img src="https://discount.one/wp-content/uploads/2023/03/favorite_romantic_wedding_count_love_like_icon_250750_1_1.svg" alt="" class="tile_img"> 
            <p class="tile_text">
               Personalized recommendations based on browsing and saved publications
            </p>
         </div>
      </div>
      <div class="reg_btn_lan_adv">
         <div class="reg_btn_lan_2">
            <a href="#reg_anchor" class="btn">
            Register
         </a>
         </div>
      </div>
   </div>

   <!-- Секция с формой регистрации -->
   <article id="reg_anchor"></article>
   <div class="registr_sec">
   
      <div class="sec_left">
         <div class="sec_title_w">
            Sign up now for access to exclusive product links
         </div>
         <p class="sec_text">
             Just one form stands between you and access to the best deals
         </p>

           <form id="reg-form">
               <div class="field_lan"><input type="text" name="login" placeholder="Your name"></div>
               <div class="field_lan">
                   <input type="text" name="email" placeholder="Email">
               </div>
               <div class="field_lan">
                  <input type="password" name="password" placeholder="Password">
               </div>

               <div class="field">
                  <div class="reg_btn_lan_3">
                     <button class="btn" type="submit">Register</button>
                  </div>
               </div>
           </form>
         <p class="registr_sec_text">
            By clicking on the "Register" button, you agree <a href="https://discount.one/privacy-policy" class="discla_text" target="_blank">with the personal data processing policy and the rules for using the service</a>
         </p>
      </div>

      <div class="sec_right">
         <img src="https://discount.one/wp-content/uploads/2023/03/headphones-lan.png" alt="">
         <!--<img src="" alt="" class=""> -->
      </div>
   </div>

   <!-- Секция с Best Deals-->
   <div class="best_deals_sec">
      <div class="sec_title">
         Best Deals
      </div>
      <div class="best_cards">
         <div class="best_card">
            <div class="best_img_block">
            <img src="https://discount.one/wp-content/uploads/2023/03/frame-1238.png" alt="" class="best_card_img_single">
            </div>
            <div class="best_middle">
               <div class="best_title_single">
                  Samsung Galaxy Tab A8 10.5 inches Display, RAM 3 GB, ROM 32 GB Expandable
               </div>
               <p class="best_text_single">
                  The Samsung Galaxy Tab A8 is a highly versatile and user-friendly tablet that is perfect for both personal and professional use
               </p>
               <div class="get_deal_no_btn">
                  Get Deal
               </div>
            </div>
         </div>

         <div class="best_card">
            <div class="best_img_block">
            <img src="https://discount.one/wp-content/uploads/2023/03/frame-1239.png" alt="" class="best_card_img_single">
            </div>
            <div class="best_middle">
               <div class="best_title_single">
                  JBL Go 2, Wireless Portable Bluetooth Speaker
               </div>
               <p class="best_text_single">
                  JBL Go 2 is a wireless portable Bluetooth speaker that delivers high-quality sound in a compact and stylish design
               </p>
               <div class="get_deal_no_btn">
                  Get Deal
               </div>
            </div>
         </div>

         <div class="best_card">
            <div class="best_img_block">
            <img src="https://discount.one/wp-content/uploads/2023/03/frame-1240.png" alt="" class="best_card_img_single">
            </div>
            <div class="best_middle">
               <div class="best_title_single">
                  Everycom EC-58 58mm (2 Inches) Direct Thermal Printer
               </div>
               <p class="best_text_single">
                  The Everycom EC-58 58mm (2 Inches) Direct Thermal Printer is a versatile and compact printing device that offers high-quality printing solutions for various applications
               </p>
               <div class="get_deal_no_btn">
                  Get Deal
               </div>
            </div>
         </div>

         <div class="best_card">
            <div class="best_img_block">
            <img src="https://discount.one/wp-content/uploads/2023/03/frame-1243.png" alt="" class="best_card_img_single">
            </div>
            <div class="best_middle">
               <div class="best_title_single">
                  Bajaj ATX 4 750-Watt Pop-up Toaster, 2-Slice Automatic Pop up Toaster
               </div>
               <p class="best_text_single">
                  The Bajaj ATX 4 750-Watt Pop-up Toaster is a compact and efficient appliance designed to make toasting breads an effortless experience
               </p>
               <div class="get_deal_no_btn">
                  Get Deal
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Секция с нижней кнопкой регистрации-->
   <div class="end_sec">
      <div class="end_pic_text">
         <img src="https://discount.one/wp-content/uploads/2023/03/icons.svg" alt="" class="end_img">
         <div class="end_text">
            Register to get access to these discounts
         </div>
      </div>
       <div class="reg_btn_lan_end">
         <a href="#reg_anchor" class="btn">
         Register
      </a>
      </div>
   </div>
</body>

<?php get_footer(); ?>

