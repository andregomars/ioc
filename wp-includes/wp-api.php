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
//		$rolesSerialized = 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:62:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}';

		$rolesJSON = '{
    "administrator": {
        "name": "Administrator",
        "capabilities": {
            "switch_themes": true,
            "edit_themes": true,
            "activate_plugins": true,
            "edit_plugins": true,
            "edit_users": true,
            "edit_files": true,
            "manage_options": true,
            "moderate_comments": true,
            "manage_categories": true,
            "manage_links": true,
            "upload_files": true,
            "import": true,
            "unfiltered_html": true,
            "edit_posts": true,
            "edit_others_posts": true,
            "edit_published_posts": true,
            "publish_posts": true,
            "edit_pages": true,
            "read": true,
        	"level_10": true,
            "level_9": true,
            "level_8": true,
            "level_7": true,
            "level_6": true,
            "level_5": true,
            "level_4": true,
            "level_3": true,
            "level_2": true,
            "level_1": true,
            "level_0": true,
            "edit_others_pages": true,
            "edit_published_pages": true,
            "publish_pages": true,
            "delete_pages": true,
            "delete_others_pages": true,
            "delete_published_pages": true,
            "delete_posts": true,
            "delete_others_posts": true,
            "delete_published_posts": true,
            "delete_private_posts": true,
            "edit_private_posts": true,
            "read_private_posts": true,
            "delete_private_pages": true,
            "edit_private_pages": true,
            "read_private_pages": true,
            "delete_users": true,
            "create_users": true,
            "unfiltered_upload": true,
            "edit_dashboard": true,
            "update_plugins": true,
            "delete_plugins": true,
            "install_plugins": true,
            "update_themes": true,
            "install_themes": true,
            "update_core": true,
            "list_users": true,
            "remove_users": true,
            "add_users": true,
            "promote_users": true,
            "edit_theme_options": true,
            "delete_themes": true,
            "export": true
        }
    },
    "editor": {
        "name": "Editor",
        "capabilities": {
            "moderate_comments": true,
            "manage_categories": true,
            "manage_links": true,
            "upload_files": true,
            "unfiltered_html": true,
            "edit_posts": true,
            "edit_others_posts": true,
            "edit_published_posts": true,
            "publish_posts": true,
            "edit_pages": true,
            "read": true,
            "level_7": true,
            "level_6": true,
            "level_5": true,
            "level_4": true,
            "level_3": true,
            "level_2": true,
            "level_1": true,
            "level_0": true,
            "edit_others_pages": true,
            "edit_published_pages": true,
            "publish_pages": true,
            "delete_pages": true,
            "delete_others_pages": true,
            "delete_published_pages": true,
            "delete_posts": true,
            "delete_others_posts": true,
            "delete_published_posts": true,
            "delete_private_posts": true,
            "edit_private_posts": true,
            "read_private_posts": true,
            "delete_private_pages": true,
            "edit_private_pages": true,
            "read_private_pages": true
        }
    },
    "author": {
        "name": "Author",
        "capabilities": {
            "upload_files": true,
            "edit_posts": true,
            "edit_published_posts": true,
            "publish_posts": true,
            "read": true,
            "level_2": true,
            "level_1": true,
            "level_0": true,
            "delete_posts": true,
            "delete_published_posts": true
        }
    },
    "contributor": {
        "name": "Contributor",
        "capabilities": {
            "edit_posts": true,
            "read": true,
            "level_1": true,
            "level_0": true,
            "delete_posts": true
        }
    },
    "subscriber": {
        "name": "Subscriber",
        "capabilities": {
            "read": true,
            "level_0": true
        }
    }
}';
		return json_decode($rolesJSON, true);
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