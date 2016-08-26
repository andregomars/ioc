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


	//duplicate from wpdb
	public function show_errors( $show = true ) {
		$errors = $this->show_errors;
		$this->show_errors = $show;
		return $errors;
	}

	//return hashed password
	public function get_hashed_pass($password) {
		$escaped_pass =  rawurlencode( str_replace("%", " ", $password) );
		$url = CORE_API_URL . 'Cipher/HashPassword/' . $escaped_pass;

		$response = wp_remote_get( $url );
		$body = wp_remote_retrieve_body( $response );
		if( $body ) 
			return json_decode($body);
		else
			return "*";
	}

	//return company list
	public function get_all_company_names() {
		$url = CORE_API_URL . 'IO_Company/';

		$response = wp_remote_get( $url );
		$body = wp_remote_retrieve_body( $response );
		if( !$body ) 
			return array();

		$io_companies = json_decode($body);
		//$io_companies = $body;
		$company_names = array('-- Please select --' => 0);
		if ($io_companies) {
			foreach($io_companies as $value) {
				$company_names[$value->Name] = $value->CompanyId;
			}
		}
		
		return $company_names;
	}

	//return io user
	public function get_user($field, $value) {
		$url = CORE_API_URL;
		switch( $field ) {
			case "ID":
				$url = $url . 'IO_Users/' . $value;
				break;
			case "user_login":
				$url = $url . 'IO_Users?loginName='.$value;
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

	//return: void
	public function insert_user($editor, $data) {
		if ( !$data )
			return 0;

		$user_login = $data['user_login'];
		$io_user = $this->get_user('user_login', $user_login);
		if ( $io_user ) {
			$this->update_user($user_login, $data);
			return;
		}

		//set user company id the same as the editor's
		$company_id = 0;
		if ( $editor ) {
			$io_editor = $this->get_user('user_login', $editor->user_login);
			if ( $io_editor )
				$company_id = $io_editor->CompanyId;
		}

		//update user basic info in db by user table id
		$url_user = CORE_API_URL . 'IO_Users/';
		$user_new = array (
			'CompanyId' => $company_id,
			'Name' => $data['display_name'],
			'LogName' => $user_login,
			'Sex' => null,
			'Pwd' => $data['user_pass'],
			'Tel' => null,
			'Email' => $data['user_email'],
			'Mobile' => null,
			'CreateTime' => date('c'),
			'LastTime' => null,
			'ValidDate' => date('c'),
			'UserType' => null,
			'HeadImage' => null,
			'IsActive' => 1,
			'Status' => 0 );

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
	}

	//return: boolean
	public function update_user($user_login, $data) {
		if ( empty($user_login) || !$data )
			return false;
		
		//fetch user id
		$ioUser = $this->get_user('user_login', $user_login);
		if ( !$ioUser)
			return false;		
		$user_id = $ioUser->UserId;

		//get user object from api
		$url_user = CORE_API_URL . 'IO_Users/' . $user_id;
		$request_get_user = wp_remote_get( $url_user );
		$response_get_user = wp_remote_retrieve_body( $request_get_user );
		if( !$response_get_user )
			return false;
		$user_update = json_decode($response_get_user, true);

		//update user basic info in db by user table id
		$user_update['Pwd'] = $data['user_pass'];
		$user_update['Email'] = $data['user_email'];
		$user_update['Name'] = $data['display_name'];
		$user_update['LastTime'] = date('c');

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

		return true;
	}

	//return: boolean
	public function update_user_caps($user_login, $caps) {
		global $current_user;
		$url_userRole = CORE_API_URL . 'UserRole/';
		$url_role = CORE_API_URL . 'Role/';

		//fetch user id
		$user = $this->get_user('user_login', $user_login);
		if ( !$user )
			return false;
		$user_id = $user->UserId;

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
		if ( !$user )
			return false;
		$user_id = $user->UserId;
		
		//delete user role relationship
		$this->update_user_caps($user_login, array());

		//delete user through api
		$url_user = CORE_API_URL . 'IO_Users/' . $user_id;
		$response_delete_user = wp_remote_delete( $url_user );
		if ( is_wp_error( $response_delete_user ) || !$response_delete_user ) {
			return false;
		} 

		return true;
	}


	//return boolean
	public function update_roles($roles) {
		global $current_user;

		//grab roles and caps individually
		$user = $current_user->user_login;
		$roleList = array();
		$capList = array();
		foreach($roles as $keyRole=>$valueRole) {
			$roleItem = array(
				'ID' => 0,
				'RoleName' => $keyRole,
				'RoleType' => 'internal',
				'RoleDescription' => $valueRole['name'],
				'InDate' => date('c'),
				'InUser' => $user,
				'EditDate' => date('c'),
				'EditUser' => $user );
			array_push($roleList, $roleItem);

			foreach($valueRole['capabilities'] as $key=>$value) {

				$capItem = array(
					'ID' => 0,
					'MenuID' => 0,
					'FunctionName' => $key,
					'FunctionDescription' => $key,
					'FunctionType' => 'WebFront',
					'Priority' => 0,
					'InDate' => date('c'),
					'InUser' => $user,
					'EditDate' => date('c'),
					'EditUser' => $user );
				if ( in_array($capItem, $capList) )
					continue;
				array_push($capList, $capItem);
			}
		}  


		//update roles through Roles batch api
		$url_roles = CORE_API_URL . 'Role/Batch';
		$optRoles = array(
			'headers' => array(
        		'Content-Type' => 'text/json'
    		),
			'body'	=> json_encode($roleList)
		);

		$response_update_roles = wp_remote_post( $url_roles, $optRoles );
		$response_update_roles_boday = wp_remote_retrieve_body( $response_update_roles );
		if ( !$response_update_roles_boday ) {
			return false;
		} 
		$new_roles = json_decode($response_update_roles_boday, true);


		//update caps through Function batch api
		$url_caps = CORE_API_URL . 'Function/Batch';
		$optCaps = array(
			'headers' => array(
        		'Content-Type' => 'text/json'
    		),
			'body'	=> json_encode($capList)
		);

		$response_update_caps = wp_remote_post( $url_caps, $optCaps );
		$response_update_caps_body = wp_remote_retrieve_body( $response_update_caps );
		if ( !$response_update_caps_body ) 
			return false;
		$new_caps = json_decode($response_update_caps_body, true);


		//map role <-> cap relationships list
		$permissionList = array();
		foreach($roles as $key_role=>$value_caps) {
			$idx_role = array_search($key_role, array_column($new_roles, 'RoleName'));
			$role_ID = $new_roles[$idx_role]['ID'];

			foreach($value_caps['capabilities'] as $cap_name=>$cap_granted) {
				$idx_cap = array_search($cap_name, array_column($new_caps, 'FunctionName'));
				$cap_ID = $new_caps[$idx_cap]['ID'];
				$permissionItem = array(
					'ID' => 0,
					'RoleID' => $role_ID,
					'FunctionID' => $cap_ID,
					'InDate' => date('c'),
					'InUser' => $user,
					'EditDate' => date('c'),
					'EditUser' => $user,
					'IsEnabled' => (int)$cap_granted );
				array_push($permissionList, $permissionItem);
			}
		}  

		//update role <-> cap list through Permission batch api
		$url_permissions = CORE_API_URL . 'Permission/Batch';
		$optPermissions = array(
			'headers' => array(
        		'Content-Type' => 'text/json'
    		),
			'body'	=> json_encode($permissionList)
		);

		$response_update_permissions = wp_remote_post( $url_permissions, $optPermissions );
		if ( is_wp_error( $response_update_permissions ) || !$response_update_permissions ) {
			return false;
		} 

		return true;
	}

	//return: boolean
	public function update_io_user($io_user) {
		if ( !$io_user )
			return false;
	
		$user_id = $io_user->UserId;
		$url_user = CORE_API_URL . 'IO_Users/' . $user_id;

		$options = array(
			'headers' => array(
				'Content-Type' => 'text/json'
			),
			'body'	=> json_encode($io_user)
		);

		$response_update_user = wp_remote_put( $url_user, $options );
		if ( is_wp_error( $response_update_user ) || !$response_update_user ) {
			return false;
		} 

		return true;
	}

	//mock of company list plugin data access
	public function get_all_companies() {
		// return array (
		// 	21 => 'I/O Controls Corporation',
		// 	22 => 'LBT',
		// 	23 => 'BYD');
		return array(21, 22, 23);
	}
}