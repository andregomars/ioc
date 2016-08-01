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

	public static function get_wpuser($field, $value) {
		$wpuser = new WP_User();

		$wpuserJSON = null;
		$url = "";
		switch( $field ) {
			case "ID":
				$url = "http://localhost:52432/api/IOCUserInfo/".$value;
				break;
			case "user_login":
				$url = "http://localhost:52432/api/IOCUserInfo?loginName=".$value;
				break;
			default:
				break;
		}

		$request = wp_remote_get( $url );
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

	//return: boolean
	public static function update_user($user_id, $data) {
		global $current_user;

		if ( $user_id < 1 || !$data )
			return false;

		$url_user = "http://localhost:52432/api/User/" . $user_id;

		//get user object id from api
		$request_get_user = wp_remote_get( $url_user );
		$response_get_user = wp_remote_retrieve_body( $request_get_user );
		if( !$response_get_user )
			return false;
		$user_update = json_decode($response_get_user, true);

		//update user basic info in db by user table id
		$user_update['Password'] = $data['user_pass'];
		$user_update['Email'] = $data['user_email'];
		$user_update['Name'] = $data['display_name'];
		$user_update['EditDate'] = date('c');
		$user_update['EditUser'] = $current_user->user_login;

		$options = array(
			'headers' => array(
				'Content-Type' => 'text/json'
			),
			'body'	=> json_encode($user_update)
		);

		$response_update_user = wp_remote_put( $url_user, $options );
		if ( is_wp_error( $response_update_user ) || !$response_update_user ) {
			return false;
		} 
	}

	//return: boolean
	public static function update_user_caps($user_id, $caps) {
		global $current_user;

		$url_userRole = "http://localhost:52432/api/UserRole/";
		$url_role = "http://localhost:52432/api/Role/";

		//get all userRole IDs of the user
		$request_get_userRole = wp_remote_get( $url_userRole );
		$response_get_userRole = wp_remote_retrieve_body( $request_get_userRole );
		if( !$response_get_userRole )
			return false;
		$allUserRoles = json_decode($response_get_userRole, true);
		$userRoleIDs = array();
		foreach ($allUserRoles as $userRole) {
			if ($userRole['UserID'] == $user_id) {
				array_push($userRoleIDs, $userRole['ID']);
			}
		}

		if (!$userRoleIDs || count($userRoleIDs) < 1) 
			return false;

		//get all roles
		$request_get_userRole = wp_remote_get( $url_role );
		$response_get_userRole = wp_remote_retrieve_body( $request_get_userRole );
		if( !$response_get_userRole )
			return false;
		$allRoles = json_decode($response_get_userRole, true);
		
		foreach ($allRoles as $role) {
			foreach ($caps as $key=>$value) {
				if (strtolower($role['RoleName']) == $key) {
					$caps[$key] = $role['ID'];
				}
			}
		}

		
		//clear existing userRole arrays
		foreach ($userRoleIDs as $id) {
			$url_userRole_delete = $url_userRole . $id;
			$response_delete_userRole = wp_remote_delete($url_userRole_delete);
			if ( is_wp_error( $response_delete_userRole ) || !$response_delete_userRole ) {
				return false;
			} 
		}

		//insert new userRole arrays
		foreach ($caps as $key=>$value) {
			$userRole = array();
			$userRole['UserID'] = $user_id;
			$userRole['RoleID'] = $value;
			$userRole['InDate'] = date('c');
			$userRole['InUser'] = $current_user->user_login;

			$options = array(
				'headers' => array(
            		'Content-Type' => 'text/json'
        		),
				'body'	=> json_encode($userRole)
			);

			$response_insert_userRole = wp_remote_post( $url_userRole, $options );
			if ( is_wp_error( $response_insert_userRole ) || !$response_insert_userRole ) {
				return false;
			} 
		}
		
		return true;
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