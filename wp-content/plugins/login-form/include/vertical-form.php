<?php
    wp_register_style( 'horizontal-form', WPA_LOGIN_DIR_URL . "css/horizontal-form.css" );
    wp_enqueue_style( 'horizontal-form' );
?>


<div class="form_style" >
    <?php
//        if($logo_image){
            print '<img src="'.$logo_image.'" id="lf_logo"><br clear="all" '.(!$logo_image?'style="display: none;"':'').'>';
//        }
    ?>

    <form class="form " id="wpadm-login-form" method="post" action="<?php print get_permalink(); ?>" id="loginform">
        <div id="lf_form_username_cont">
            <input class="input_style" value=""  type="text" name="log" placeholder="<?php echo __( 'Username', 'login-form' ); ?>">
        </div>

        <div class="password-input-box" id="lf_form_password_cont">
            <input class="input_style  password-input"  type="password" name="pwd" placeholder="<?php echo __( 'Password', 'login-form' ); ?>">
        </div>

        <?php if (WPA_LOGIN_PRO) {
            login_form_pro::getHTMLCaptcha(true);
        }?>

        <input  class="button button-primary button-large submit_style" type="submit" value="<?php echo __( 'Log in', 'login-form' ); ?>" name="submit">

        <div class="" id="lf_form_remember_cont">
            <input type="hidden" name="action" value="<?=$action_value?>">
            <input type="checkbox" name="rememberme" value="forever">
            <label><?php echo __( 'Remember?', 'login-form' ); ?></label>
        </div>
    </form>

    <style>
        .form_style input {
            margin: 10px 5px ;
        }
        .form_style .input_style, .form_style .submit_style { 
            width:272px;
        }

        <?php print $style; ?>
    </style>
    </div>
    