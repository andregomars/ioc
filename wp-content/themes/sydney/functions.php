<?php
/**
 * Sydney functions and definitions
 *
 * @package Sydney
 */


if ( ! function_exists( 'sydney_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sydney_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sydney, use a find and replace
	 * to change 'sydney' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sydney', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; /* pixels */
	}	

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('sydney-large-thumb', 830);
	add_image_size('sydney-medium-thumb', 550, 400, true);
	add_image_size('sydney-small-thumb', 230);
	add_image_size('sydney-service-thumb', 350);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sydney' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sydney_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // sydney_setup
add_action( 'after_setup_theme', 'sydney_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sydney_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sydney' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//by andre
	register_sidebar( array(
		'name'          => __( 'Sidebar_es', 'sydney' ),
		'id'            => 'sidebar-es',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar_cn', 'sydney' ),
		'id'            => 'sidebar-cn',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	//by andre end

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'sydney' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	//Register the front page widgets
	if ( function_exists('siteorigin_panels_activate') ) {
		register_widget( 'Sydney_List' );
		register_widget( 'Sydney_Services_Type_A' );
		register_widget( 'Sydney_Services_Type_B' );
		register_widget( 'Sydney_Facts' );
		register_widget( 'Sydney_Clients' );
		register_widget( 'Sydney_Testimonials' );
		register_widget( 'Sydney_Skills' );
		register_widget( 'Sydney_Action' );
		register_widget( 'Sydney_Video_Widget' );
		register_widget( 'Sydney_Social_Profile' );
		register_widget( 'Sydney_Employees' );
		register_widget( 'Sydney_Latest_News' );
		register_widget( 'Sydney_Contact_Info' );
	}

}
add_action( 'widgets_init', 'sydney_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( function_exists('siteorigin_panels_activate') ) {
	require get_template_directory() . "/widgets/fp-list.php";
	require get_template_directory() . "/widgets/fp-services-type-a.php";
	require get_template_directory() . "/widgets/fp-services-type-b.php";
	require get_template_directory() . "/widgets/fp-facts.php";
	require get_template_directory() . "/widgets/fp-clients.php";
	require get_template_directory() . "/widgets/fp-testimonials.php";
	require get_template_directory() . "/widgets/fp-skills.php";
	require get_template_directory() . "/widgets/fp-call-to-action.php";
	require get_template_directory() . "/widgets/video-widget.php";
	require get_template_directory() . "/widgets/fp-social.php";
	require get_template_directory() . "/widgets/fp-employees.php";
	require get_template_directory() . "/widgets/fp-latest-news.php";
	require get_template_directory() . "/widgets/contact-info.php";
}

/**
 * Enqueue scripts and styles.
 */
function sydney_scripts() {

	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'sydney-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) ); 
	} else {
	    wp_enqueue_style( 'sydney-body-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'sydney-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) ); 
	} else {
	    wp_enqueue_style( 'sydney-headings-fonts', '//fonts.googleapis.com/css?family=Raleway:400,500,600'); 
	}	

	wp_enqueue_style( 'sydney-style', get_stylesheet_uri() );

	wp_enqueue_style( 'sydney-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );		

	wp_enqueue_style( 'sydney-ie9', get_template_directory_uri() . '/css/ie9.css', array( 'sydney-style' ) );
	wp_style_add_data( 'sydney-ie9', 'conditional', 'lte IE 9' );	

	wp_enqueue_script( 'sydney-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true );

	wp_enqueue_script( 'sydney-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'),'', true );

	wp_enqueue_script( 'sydney-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( get_theme_mod('blog_layout') == 'masonry-layout' && (is_home() || is_archive()) ) {

		wp_enqueue_script( 'sydney-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('jquery-masonry'),'', true );		
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sydney_scripts' );

/**
 * Enqueue Bootstrap
 */
function sydney_enqueue_bootstrap() {
	wp_enqueue_style( 'sydney-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'sydney_enqueue_bootstrap', 9 );

/**
 * Change the excerpt length
 */
function sydney_excerpt_length( $length ) {
  
  $excerpt = get_theme_mod('exc_lenght', '55');
  return $excerpt;

}
add_filter( 'excerpt_length', 'sydney_excerpt_length', 999 );

/**
 * Blog layout
 */
function sydney_blog_layout() {
	$layout = get_theme_mod('blog_layout','classic');
	return $layout;
}

/**
 * Menu fallback
 */
function sydney_menu_fallback() {
	echo '<a class="menu-fallback" href="' . admin_url('nav-menus.php') . '">' . __( 'Create your menu here', 'sydney' ) . '</a>';
}

/**
 * Header image overlay
 */
function sydney_header_overlay() {
	$overlay = get_theme_mod( 'hide_overlay', 0);
	if ( !$overlay ) {
		echo '<div class="overlay"></div>';
	}
}

/**
 * Polylang compatibility
 */
if ( function_exists('pll_register_string') ) :
function sydney_polylang() {
	for ( $i=1; $i<=5; $i++) {
		pll_register_string('Slide title ' . $i, get_theme_mod('slider_title_' . $i), 'Sydney');
		pll_register_string('Slide subtitle ' . $i, get_theme_mod('slider_subtitle_' . $i), 'Sydney');
	}
	pll_register_string('Slider button text', get_theme_mod('slider_button_text'), 'Sydney');
	pll_register_string('Slider button URL', get_theme_mod('slider_button_url'), 'Sydney');
}
add_action( 'admin_init', 'sydney_polylang' );
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Page builder support
 */
require get_template_directory() . '/inc/page-builder.php';

/**
 * Slider
 */
require get_template_directory() . '/inc/slider.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Theme info
 */
require get_template_directory() . '/inc/theme-info.php';

/**
 * Woocommerce basic integration
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 *TGM Plugin activation.
 */
require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'sydney_recommend_plugin' );
function sydney_recommend_plugin() {
 
    $plugins[] = array(
            'name'               => 'Page Builder by SiteOrigin',
            'slug'               => 'siteorigin-panels',
            'required'           => false,
    );

	if ( !function_exists('wpcf_init') ) {
	    $plugins[] = array(
		        'name'               => 'Sydney Toolbox - custom posts and fields for the Sydney theme',
		        'slug'               => 'sydney-toolbox',
		        'required'           => false,
		);
	}
 
    tgmpa( $plugins);
 
}

//by andre

/*
 * remove actions:
 * - sydney theme recommended plugin notices
 * - admin_color_scheme_picker
 */
remove_action( 'tgmpa_register', 'sydney_recommend_plugin' );
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

/**
 * remove wp logo, updates, comments from admin bar in the top
 */
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    // $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    // $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    // $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    // $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    // $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    // $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    // $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    // $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    // $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    // $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}


add_action('login_head', 'custom_login_logo');
function custom_login_logo() {
	echo '<style type="text/css">
			h1 a { background-image: url('.get_bloginfo('template_directory').'/images/logo.login.png) !important;  }
	</style>';
}


add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
  
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
  remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings
  
}

/*
 * replace wp-admin to admin folder
*/
add_filter('site_url',  'wpadmin_filter', 10, 3);
function wpadmin_filter( $url, $path, $orig_scheme ) {
  $old  = array( "/(wp-admin)/");
  $admin_dir = WP_ADMIN_DIR;
  $new  = array($admin_dir);
  return preg_replace( $old, $new, $url, 1);
 }

/*
 * replace login logo link and tooltip
*/
add_filter('login_headerurl','loginpage_custom_link');
function loginpage_custom_link() {
	return get_site_url();
}

add_filter('login_headertitle', 'change_title_on_logo');
function change_title_on_logo() {
	return get_bloginfo('name');
}

/*
 * remove help tab in admin page right up corner
 */
add_action( 'admin_head', 'hide_update_notice_to_all_but_admin_users', 998 );
function hide_update_notice_to_all_but_admin_users()
{
    remove_action( 'admin_notices', 'update_nag', 3 );
}


/*
 * remove help tab in admin page right up coner
 */
function remove_help($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter( 'contextual_help', 'remove_help', 999, 3 );



/*
 * To show the extra profile of company ID
 * Note there are two actions tags. show_user_profile is for showing the form on your own profile, and edit_user_profile is for showing it on everyone else’s.
 */
add_action( 'show_user_profile', 'show_extra_in_profile' );
add_action( 'edit_user_profile', 'show_extra_in_profile' );
function show_extra_in_profile( $user ) { 
	global $wpapi;
	//$user_info = get_userdata($user->ID);
	//if (!$user_info)
	//	return false;
	$ioUser = $wpapi->get_user('user_login', $user->user_login);
	if (!$ioUser)
		return false;
	?>
     
    <table class="form-table">
         <tr>
            <th><label>Work Phone</label></th>
            <td>
				<input type="tel" name="txt_tel" id="txt_tel" 
					value="<?php echo $ioUser->Tel; ?>" />
        	</td>
        </tr>
         <tr>
            <th><label>Cell Phone</label></th>
            <td>
				<input type="tel" name="txt_mobile" id="txt_mobile" 
					value="<?php echo $ioUser->Mobile; ?>" />
        	</td>
        </tr>
        <tr>
            <th><label>Gender</label></th>
            <td>
        		<select name="dpl_sex" id="dpl_sex">
	        	<?php
				    $sex_selected = $ioUser->Sex;
				    $list_sex = get_the_author_meta( 'sex', $user->ID );
		 			foreach ( $list_sex as $key => $value ) {
		 				if ($value === $sex_selected) {
		 				?>
							<option selected="selected" value=<?php echo $value; ?>><?php echo $key; ?></option>
						<?php
		 				}
		 				else {
		 				?>
							<option value=<?php echo $value; ?>><?php echo $key; ?></option>
						<?php
		 				}
					}
				?>
				</select>
        	</td>
        </tr>

        <?php if ( current_user_can('administrator') ):  ?>
        <tr>
            <th><label>Comapny ID</label></th>
            <td>
        		<select name="dpl_company_id" id="dpl_company_id">
	        	<?php
				    $company_id_selected = $ioUser->CompanyId;
				    $list_company = get_the_author_meta( 'company_id', $user->ID );
		 			foreach ( $list_company as $key => $value ) {
		 				if ($value === $company_id_selected) {
		 				?>
							<option selected="selected" value=<?php echo $value; ?>><?php echo $key; ?></option>
						<?php
		 				}
		 				else {
		 				?>
							<option value=<?php echo $value; ?>><?php echo $key; ?></option>
						<?php
		 				}
					}
				?>
				</select><br/>
				<span class="description">Please set I/O Controls Company ID.</span>
        	</td>
        </tr>
        <tr>
        	<th><label>User Type</label></th>
        	<td>
        		<select name="dpl_user_type" id="dpl_user_type">
	        	<?php
				    $user_type_selected = $ioUser->UserType;
				    $list_user_type = get_the_author_meta( 'user_type', $user->ID );
		 			foreach ( $list_user_type as $key => $value ) {
		 				if ($value === $user_type_selected) {
		 				?>
							<option selected="selected" value=<?php echo $value; ?>><?php echo $key; ?></option>
						<?php
		 				}
		 				else {
		 				?>
							<option value=<?php echo $value; ?>><?php echo $key; ?></option>
						<?php
		 				}
					}
				?>
				</select><br/>
				<span class="description">Please select a I/O Controls User Type.</span>
        	</td>
        </tr>
        <?php endif;  ?>
    </table>
<?php 
}

/*
 * Get sex dictionary
 */
add_filter( 'get_the_author_sex', 'get_user_sex', 999, 3 );
function get_user_sex($value, $user_id, $original_user_id){
	return array (
		'-- Blank --' => null,
		'Female' => 0,
		'Male' => 1);
}

/*
 * Get company dictionary from api
 */
add_filter( 'get_the_author_company_id', 'get_user_company_list', 999, 3 );
function get_user_company_list($value, $user_id, $original_user_id){
	global $wpapi;
	return $wpapi->get_all_company_names();
}

/*
 * Get uer type dictionary list from other external resouce
 */
add_filter( 'get_the_author_user_type', 'get_user_type_list', 999, 3 );
function get_user_type_list($value, $user_id, $original_user_id){
	return array (
		'-- Please select --' => null,
		'IO Control User' => 2,
		'IO Control Administrator' => 4,
		'Consumer User' => 8,
		'Consumer Administrator' => 16,
		'Manufacturer User' => 32,
		'Manufacturer Administrator' => 64);
}

/* To save the extra profile of company code
 * Also note the two add_action functions. Similar to above one of them applies to your own profile page, and the other to everyone elses.
 */
add_action( 'personal_options_update', 'save_extra_in_profile' );
add_action( 'edit_user_profile_update', 'save_extra_in_profile' );
function save_extra_in_profile( $user_id ) {
 	global $wpapi;

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
 
    //update_usermeta( absint( $user_id ), 'company_id', wp_kses_post( $_POST['companyID'] ) );
    $user_tel = wp_kses_post( $_POST['txt_tel'] );
    $user_mobile = wp_kses_post( $_POST['txt_mobile'] );
    $user_sex = wp_kses_post( $_POST['dpl_sex'] );
    $company_id = wp_kses_post( $_POST['dpl_company_id'] );
    $user_type = wp_kses_post( $_POST['dpl_user_type'] );


    $user_info = get_userdata($user_id);
    if (!$user_info)
    	return false;
    $ioUser = $wpapi->get_user('user_login', $user_info->user_login);
    if (!$ioUser)
    	return false;

    $ioUser->Tel = $user_tel;
    $ioUser->Mobile = $user_mobile;
    $ioUser->Sex = $user_sex;
    $ioUser->CompanyId = $company_id;
    $ioUser->UserType = $user_type;

    return $wpapi->update_io_user($ioUser);
}

/*
 * add Company ID column header in user list
 */
add_filter('manage_users_columns', 'add_extra_users_column');
function add_extra_users_column($columns) {
    $columns['company_name'] = 'Company';
    return $columns;
}

/*
 * fill company ID column values in user list
 */
add_action('manage_users_custom_column',  'manage_extra_users_column', 10, 3);
function manage_extra_users_column($value, $column_name, $user_id) {
	global $wpapi;

	if ( 'company_name' == $column_name ) {
		$dict_company = get_user_company_list($value, $user_id, $user_id);
		$user = get_user_by('ID', $user_id);
		$io_user = $wpapi->get_user('user_login', $user->user_login);
		if(!$dict_company || !$io_user)
			return '';
		foreach ($dict_company as $key=>$value) {
			if ($value == $io_user->CompanyId) {
				if (!$value)
					return '';
				else 
					return $key;
			}
		}

	}

	//return $value . '<br/>'. get_user_meta('city', $user_id);
}

/*
 * set profile picture description to empty
 */
add_filter('user_profile_picture_description', 'set_profile_avartar_desc');
function set_profile_avartar_desc($description) {
    return '';
}

/*
 * pre get header image
 */
add_filter('get_avatar_url', 'get_header_image_url', 999, 3);
function get_header_image_url($url, $id_or_email, $args) {
    global $wpapi;

    $user = get_user_by('ID', $id_or_email);
    if (!$user) 
    	return null;
    $io_user = $wpapi->get_user('user_login', $user->user_login);
    if (!$io_user || !$io_user->HeadImage || empty($io_user->HeadImage))
    	return null;
    
    return HEAD_IMAGE_URL . trim($io_user->HeadImage). '.jpg';
}


//by andre end