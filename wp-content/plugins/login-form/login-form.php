<?php
/*
Plugin Name: login-form
Description: Login Form with security and style features
Version: 2.0.3
Author: www.wpadm.com
Domain Path: /languages
Text Domain: login-form
*/

define ('WPA_LOGIN_DIR', dirname(__FILE__) );
define ('WPA_LOGIN_DIR_URL', plugin_dir_url(__FILE__)); 
define('WPA_SERVER_URL', 'http://secure.wpadm.com/');

load_theme_textdomain( 'login-form', dirname(__FILE__) . '/languages' );

require WPA_LOGIN_DIR . '/class/class-login.php';

$wpadm_login = new wpadm_login;
if (get_option('login-form-pro-key') && !file_exists(WPA_LOGIN_DIR . '/class/class-pro.php')) {
    $wpadm_login->updatePlugin();
}


if (file_exists(WPA_LOGIN_DIR . '/class/class-pro.php')) {
    require WPA_LOGIN_DIR . '/class/class-pro.php';
    define('WPA_LOGIN_PRO', true);
} else {
    define('WPA_LOGIN_PRO', false);
}




add_action('admin_notices', array($wpadm_login, 'notice'));

function wpadm_login() {
 
    global $wpadm_login;
     
    return $wpadm_login -> show();
}

            
add_shortcode('wpadm-login', 'wpadm_login');

function wpadm_login_init_before_headers(){
    
    global $wpadm_login;
    
    $wpadm_login -> actions(); 
}

add_action('template_redirect', 'wpadm_login_init_before_headers');



if ( is_admin() ){ 
    
     require ( WPA_LOGIN_DIR . '/include/admin/custom_fields_functions.php' ); 
     require ( WPA_LOGIN_DIR . '/include/admin/main-setting.php' ); 
}


function hide_login_form() {
 
   if(get_option("form-stealth-hide-wplogin") == 1 ) {

		if(basename($_SERVER['SCRIPT_FILENAME']) == 'wp-login.php') {
		
            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                    do_action( 'login_init' ); 
                    
                    do_action( 'login_form_' . $_GET['action'] ); 
                    
                    check_admin_referer('log-out');

                    $user = wp_get_current_user();

                    wp_logout();
            }
            
            $url = home_url(); 
                    
            wp_redirect($url, 302);
			exit;
		}
	} 
}

function requestURI1()
{
	$part = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$part = trim($part, "/");
	$part = strtolower($part);
	$part = explode("/", $part);
	return $part[0];
}

add_action('init', 'hide_login_form');
add_action('admin_menu', 'lf_generate_menu');

add_action( 'wp_ajax_lf_stopNotice5Stars', array($wpadm_login, 'stopNotice5Stars') );
add_action( 'wp_ajax_lf_sendSupport', array($wpadm_login, 'sendSupport') );

function lf_generate_menu() {
    $pages = array();

    $menu_position = '1.9998887770';
    $pages[] = add_menu_page(
        'Login Form',
        'Login Form',
        'read',
        'main-setting',
        'wpalogin_main_setting',
        plugins_url('/img/icon.png',__FILE__),
        $menu_position
    );


//    $pages[] = add_options_page(
//        'Analytics Counter Settings',
//        'Analytics Counter',
//        'administrator',
//        WPADM_GA__MENU_PREFIX . 'settings',
//        array('Wpadm_GA', 'settingsView')
//    );


}

  