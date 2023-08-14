<?php
$user = wp_get_current_user();
$usermeta = get_user_meta( get_current_user_id() );
?>
<div class="account__content account__content_short">
    <div class="account__pill account__pill_big">
        <div class="account__pill-picture account__pill-picture_big">
            <?php echo get_avatar(get_current_user_id(), 140); ?>
        </div>
        <div class="account__pill-name account__pill-name_big">
            <?=$user->display_name ?>
            <span class="account__pill-email"><?=$user->user_email ?></span>
        </div>
    </div>
    <div class="account__fields">
        <form id="personal-save">
			<div class="flex_personal">
            <div class="field"><label>E-mail</label><input type="text" name="email" value="<?=$user->user_email ?>" disabled></div>
            <div class="field"><label>Name</label><input type="text" name="display_name" value="<?=$user->display_name ?>"></div>
			<div class="field"><label>Location</label><input type="text" name="city" value="<?=$user->city ?>"></div>
			<div class="field"><label>Date</label><input type="date" name="display_date" value="<?=$user->display_date ?>"></div>
            <!--<div class="field"><label>Description</label><input type="text" name="description" value="<?=$usermeta['description'][0] ?>"></div> -->
            <!-- <div class="field field_separate">
                <label>Change password</label>
                <input type="password" name="password" placeholder="New password">
            </div> -->
            <!-- <div class="account__remove"><a href="#">Delete account</a></div> -->
							
			</div>
            <div class="buttons">
                <button class="btn" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="account__regdate">Date of registration: <span><?php echo $user->user_registered; ?></span></div>
</div>