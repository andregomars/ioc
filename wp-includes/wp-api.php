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

		$userJSON = null;
		$url = "";
		switch( $field ) {
			case "ID":
				$url = "http://localhost:52432/api/IOCUser/".$value;
				break;
			case "user_login":
				$url = "http://localhost:52432/api/IOCUser?loginName=".$value;
				break;
			case "email":
				break;
			default:
				break;
		}
		
		$request = wp_remote_get( $url );
		$response = wp_remote_retrieve_body( $request );
		if( $response ) 
			$userJSON = json_decode($response, true);

		return (object)$userJSON;
	}

	public static function get_wpuser($username) {
		$wpuser = new WP_User();

		$wpuserJSON = null;
		$url = "http://localhost:52432/api/IOCUserInfo?loginName=".$username;
		$request = wp_remote_get( "$url" );
		$response = wp_remote_retrieve_body( $request );
		if( !$response )
			return null;

		$wpuserJSON = (object)json_decode($response, true);
		$wpuser->ID = $wpuserJSON->ID;
		$wpuser->cap_key = $wpuserJSON->cap_key;
		$wpuser->caps = $wpuserJSON->caps;
		$wpuser->data = (object)$wpuserJSON->data;
		$wpuser->filter = $wpuserJSON->filter;
		$wpuser->roles = $wpuserJSON->roles;
		$wpuser->allcaps = $wpuserJSON->allcaps;

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