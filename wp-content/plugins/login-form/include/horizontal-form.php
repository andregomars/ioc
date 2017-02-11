<?php
    wp_register_style( 'horizontal-form', WPA_LOGIN_DIR_URL . "css/horizontal-form.css" );
    wp_enqueue_style( 'horizontal-form' );
?>


<div class="form_style horizontal-form" >		
    <?php
//        if($logo_image){
            print '<img src="'.$logo_image.'" id="lf_logo"><br clear="all" '.(!$logo_image?'style="display: none;"':'').'>';
//        }
    ?>

    <form class="form" id="wpadm-login-form" method="post" action="<?php print get_permalink(); ?>" id="loginform">
        <div style="display: inline" id="lf_form_username_cont">
            <input class="input_style" value="" type="text" name="log" placeholder="<?php echo __( 'Username', 'login-form' ); ?>">
        </div>

        <div style="display: inline" id="lf_form_password_cont">
            <input class="input_style password-input"  type="password" name="pwd" placeholder="<?php echo __( 'Password', 'login-form' ); ?>">
        </div>

        <?php if (WPA_LOGIN_PRO) {
            login_form_pro::getHTMLCaptcha($demo);
        }?>

        <input  class="button button-primary button-large submit_style" type="submit" value="<?php echo __( 'Log in', 'login-form' ); ?>" name="submit">

        <div class="forgetmenot" id="lf_form_remember_cont">
            <input type="hidden" name="action" value="<?=$action_value?>" id="lf_form_remember_cont">
            <label><input type="checkbox" name="rememberme" value="forever"><?php echo __( 'Remember?', 'login-form' ); ?></label>
        </div>
    </form>

    <style>









        <?php print $style; ?>
    </style>
</div>
