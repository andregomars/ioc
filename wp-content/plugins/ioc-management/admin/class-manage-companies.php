<?php

final class IOC_Admin_Manage_Companies {


	private static $instance;

	public $page = '';

	public $page_obj = '';

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
	}

	public function add_admin_page() {

		// The "Companies" page should be shown for anyone that has the 'list_roles', 'edit_roles', or
		// 'delete_roles' caps, so we're checking against all three.
		$edit_roles_cap = 'list_roles';

		// If the current user can 'edit_roles'.
		if ( current_user_can( 'edit_roles' ) )
			$edit_roles_cap = 'edit_roles';

		// If the current user can 'delete_roles'.
		elseif ( current_user_can( 'delete_roles' ) )
			$edit_roles_cap = 'delete_roles';

		// Get the page title.
		$title = esc_html__( 'Companies', 'iocmanagement' );

		if ( isset( $_GET['action'] ) && 'edit' === $_GET['action'] && isset( $_GET['role'] ) )
			$title = esc_html__( 'Edit Company', 'iocmanagement' );

		// Create the Manage Companies page.
		$this->page = add_submenu_page( 'users.php', $title, esc_html__( 'Companies', 'iocmanagement' ), $edit_roles_cap, 'companies', array( $this, 'page' ) );

		// Let's roll if we have a page.
		if ( $this->page ) {

			// If viewing the edit company page.
			if ( isset( $_REQUEST['action'] ) && 'edit' === $_REQUEST['action'] && current_user_can( 'edit_roles' ) )
				$this->page_obj = null; //new Members_Admin_Role_Edit();

			// If viewing the company list page.
			else
				$this->page_obj = new IOC_Admin_Companies();

			// Load actions.
			add_action( "load-{$this->page}", array( $this, 'load' ) );

			// Load scripts/styles.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		}
	}


	public function load() {

		if ( method_exists( $this->page_obj, 'load' ) )
			$this->page_obj->load();
	}

	public function enqueue( $hook_suffix ) {

		if ( $this->page === $hook_suffix && method_exists( $this->page_obj, 'enqueue' ) )
			$this->page_obj->enqueue();
	}

	public function page() {

		if ( method_exists( $this->page_obj, 'page' ) )
			$this->page_obj->page();
	}

	public static function get_instance() {

		if ( ! self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

IOC_Admin_Manage_Companies::get_instance();
