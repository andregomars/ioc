<?php

class wpapi {

	var $show_errors = false;

	public function __construct() {

		if ( WP_DEBUG && WP_DEBUG_DISPLAY )
			$this->show_errors();

		$this->init();
	}

	public function init() {
		//initialize something here..
	}

	public static function get_user($field, $value) {
		$data = array(
		    "ID" => 5
		    ,"user_login" => "iocdbo"
		    ,"user_pass" => "8be4177df4ec5dee8c8bc4f3b49d7a2d"  //1111
		    //,"user_pass" => "\$P\$BttNosmG.1S4KlsuiQPDcjCLIAyHWk0"
		    ,"user_nicename" => "iocdbo"
		    ,"user_email" => "andregomars@gmail.com"
		    ,"user_url" => ""
		    ,"user_registered" => "2016-06-05 00:16:33"
		    ,"user_activation_key" => ""
		    ,"user_status" => 0
		    ,"display_name" => "iocdbo"
		    ,"spam" => 0
		    ,"deleted" => 0
    	);

    	$user = (object)$data;

		if ( $field == 'ID' && $value == 5)
	    	return $user;
	    elseif ( $field == 'user_login' && $value == 'iocdbo' )
	    	return $user;
	    elseif ( $field == 'email' && $value == 'iocdbo@gmail.com' )
	    	return $user;
	    else
	    	return null;
	}

	public static function get_wpuser($username) {
		$wpuser = new WP_User();

		if ( $username == 'iocdbo') {
		    $wpuser->ID = 5;
		    $wpuser->cap_key = "ioc_capabilities";
		    $wpuser->caps = array( "administrator" => 1);
		    $wpuser->data = self::get_user('user_login', $username);
		    $wpuser->filter = '';
		    $wpuser->roles = array( 0 => "administrator");
			$wpuser->allcaps = array( "switch_themes" => 1
	            ,"edit_themes" => 1
	            ,"activate_plugins" => 1
	            ,"edit_plugins" => 1
	            ,"edit_users" => 1
	            ,"edit_files" => 1
	            ,"manage_options" => 1
	            ,"moderate_comments" => 1
	            ,"manage_categories" => 1
	            ,"manage_links" => 1
	            ,"upload_files" => 1
	            ,"import" => 1
	            ,"unfiltered_html" => 1
	            ,"edit_posts" => 1
	            ,"edit_others_posts" => 1
	            ,"edit_published_posts" => 1
	            ,"publish_posts" => 1
	            ,"edit_pages" => 1
	            ,"read" => 1
	            ,"level_10" => 1
	            ,"level_9" => 1
	            ,"level_8" => 1
	            ,"level_7" => 1
	            ,"level_6" => 1
	            ,"level_5" => 1
	            ,"level_4" => 1
	            ,"level_3" => 1
	            ,"level_2" => 1
	            ,"level_1" => 1
	            ,"level_0" => 1
	            ,"edit_others_pages" => 1
	            ,"edit_published_pages" => 1
	            ,"publish_pages" => 1
	            ,"delete_pages" => 1
	            ,"delete_others_pages" => 1
	            ,"delete_published_pages" => 1
	            ,"delete_posts" => 1
	            ,"delete_others_posts" => 1
	            ,"delete_published_posts" => 1
	            ,"delete_private_posts" => 1
	            ,"edit_private_posts" => 1
	            ,"read_private_posts" => 1
	            ,"delete_private_pages" => 1
	            ,"edit_private_pages" => 1
	            ,"read_private_pages" => 1
	            ,"delete_users" => 1
	            ,"create_users" => 1
	            ,"unfiltered_upload" => 1
	            ,"edit_dashboard" => 1
	            ,"update_plugins" => 1
	            ,"delete_plugins" => 1
	            ,"install_plugins" => 1
	            ,"update_themes" => 1
	            ,"install_themes" => 1
	            ,"update_core" => 1
	            ,"list_users" => 1
	            ,"remove_users" => 1
	            ,"add_users" => 1
	            ,"promote_users" => 1
	            ,"edit_theme_options" => 1
	            ,"delete_themes" => 1
	            ,"export" => 1
	            ,"administrator" => 1);

		}
		else {
			$wpuser = null;
		}

		return $wpuser;
	}

	public static function insert_user($data) {
		error_log('insert user from wpapi is: '.print_r($data,1));
		return 22;
	}

	public static function update_user_meta($user_id, $key, $value) {
		error_log('update user meta from wpapi, user_id:'.$user_id.', '.$key.':'.$value);
	}

	public static function delete_user($user_id) {
		error_log('delete user from wpapi is: '.print_r($user_id,1));
	}

	public static function get_all_roles() {
		$rolesJSON = null;
		$url = "http://localhost:52432/api/IOCRolesAll";
		$request = wp_remote_get( "$url" );
		$response = wp_remote_retrieve_body( $request );
		if( $response ) 
			$rolesJSON = json_decode($response, true);

		return $rolesJSON;
	}

	public static function get_counted_users() {
		//$val = 'a:2:{s:11:"total_users";i:4;s:11:"avail_roles";a:4:{s:13:"administrator";i:2;s:6:"editor";i:1;s:10:"subscriber";i:1;s:4:"none";i:0;}}';
		$valJSON = '{"total_users":4,"avail_roles":{"administrator":2,"editor":1,"subscriber":1,"none":0}}'; 
		return json_decode($valJSON, true);
	}

	//duplicate from wpdb
	public function show_errors( $show = true ) {
		$errors = $this->show_errors;
		$this->show_errors = $show;
		return $errors;
	}



}