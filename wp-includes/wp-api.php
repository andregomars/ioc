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

	//return core user
	public function get_user($field, $value) {
		$url = CORE_API_URL;
		switch( $field ) {
			case "ID":
				$url = $url . 'User/' . $value;
				break;
			case "user_login":
				$url = $url . '/IOCUser?loginName='.$value;
				break;
			case "email":
				break;
			default:
				break;
		}

		$response = wp_remote_get( $url );
		$body = wp_remote_retrieve_body( $response );
		if( $body ) 
			return json_decode($body);
		else
			return null;
	}

	//return: user ID
	public function insert_user($data) {
		global $current_user;

		if ( !$data )
			return 0;
		
		//update user basic info in db by user table id
		$url_user = CORE_API_URL . 'User/';
		$user_new = array (
			'LoginName' => $data['user_login'],
			'Password' => $data['user_pass'],
			'Email' => $data['user_email'],
			'Name' => $data['display_name'],
			'UserType' => 'internal',
			'CompanyID' => 0,
			'IsAdmin' => 0,
			'InDate' => date('c'),
			'InUser' => $current_user->user_login,
			'Status' => 'Active' );
		
		$options = array(
			'headers' => array(
				'Content-Type' => 'text/json'
			),
			'body'	=> json_encode($user_new)
		);

		$response_insert_user = wp_remote_post( $url_user, $options );
		if ( is_wp_error( $response_insert_user ) || !$response_insert_user ) {
			return 0;
		} 

		$responseBody = wp_remote_retrieve_body( $response_insert_user );
		$user_id = json_decode($responseBody)->ID;

		return $user_id;
	}

	//return: boolean
	public function update_user($user_login, $data) {
		global $current_user;

		if ( empty($user_login) || !$data )
			return false;
		
		//fetch user id
		$iocUser = $this->get_user('user_login', $user_login);
		$user_id = $iocUser->ID;

		if ( !$user_id || $user_id < 1 )
			return false;

		//get user object from api
		$url_user = CORE_API_URL . 'User/' . $user_id;
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
	public function update_user_caps($user_login, $caps) {
		global $current_user;
		$url_userRole = CORE_API_URL . 'UserRole/';
		$url_role = CORE_API_URL . 'Role/';

		//fetch user id
		$user = $this->get_user('user_login', $user_login);
		$user_id = $user->ID;
		if ( !$user_id || $user_id < 1 )
			return false;

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

		//get all roles
		$request_get_userRole = wp_remote_get( $url_role );
		$response_get_userRole = wp_remote_retrieve_body( $request_get_userRole );
		if( !$response_get_userRole )
			return false;
		$allRoles = json_decode($response_get_userRole, true);
		
		//assign new role with role ID
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

	//return: boolean
	public function delete_user($user_login) {
		//fetch user id
		$user = $this->get_user('user_login', $user_login);
		$user_id = $user->ID;
		if ( !$user_id || $user_id < 1 )
			return false;
		
		//delete user role relationship
		$this->update_user_caps($user_login, array());

		//delete user through api
		$url_user = CORE_API_URL . 'User/' . $user_id;
		$response_delete_user = wp_remote_delete( $url_user );
		if ( is_wp_error( $response_delete_user ) || !$response_delete_user ) {
			return false;
		} 

		return true;
	}

	public function get_all_roles() {
		$rolesJSON = null;
		$url = CORE_API_URL . 'IOCRolesAll';
		$request = wp_remote_get( "$url" );
		$response = wp_remote_retrieve_body( $request );
		if( $response ) 
			$rolesJSON = json_decode($response, true);

		return $rolesJSON;
	}


	//duplicate from wpdb
	public function show_errors( $show = true ) {
		$errors = $this->show_errors;
		$this->show_errors = $show;
		return $errors;
	}


/*
	public function get_counted_users() {
		//$val = 'a:2:{s:11:"total_users";i:4;s:11:"avail_roles";a:4:{s:13:"administrator";i:2;s:6:"editor";i:1;s:10:"subscriber";i:1;s:4:"none";i:0;}}';
		$valJSON = '{"total_users":4,"avail_roles":{"administrator":2,"editor":1,"subscriber":1,"none":0}}'; 
		return json_decode($valJSON, true);
	}

	public static function get_ioc_user($field, $value) {
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
*/

}