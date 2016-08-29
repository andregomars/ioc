<?php
/*
Plugin Name: I/O Controls Management
Plugin URI: http://www.iocontrols.com/
Version: 1.0.1
Author: Andre
Author URI: https://www.linkedin.com/in/andregomars
Description: I/O Controls Inc. managment modules
Text Domain: ioc-management
Domain Path: /languages
 */
final class IOC_Management_Plugin {

	public $dir_path = '';

	public $dir_uri = '';

	public $admin_dir = '';

	public $inc_dir = '';

	public $templates_dir = '';

	public $css_uri = '';

	public $js_uri = '';

	public $role_user_count = array();

	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new IOC_Management_Plugin;
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
		}

		return $instance;
	}

	private function __construct() {}

	public function __toString() {
		return 'iocmanagement';
	}

	private function setup() {

		// Main plugin directory path and URI.
		$this->dir_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->dir_uri  = trailingslashit( plugin_dir_url(  __FILE__ ) );

		// Plugin directory paths.
		$this->inc_dir       = trailingslashit( $this->dir_path . 'inc'       );
		$this->admin_dir     = trailingslashit( $this->dir_path . 'admin'     );
		$this->templates_dir = trailingslashit( $this->dir_path . 'templates' );

		// Plugin directory URIs.
		$this->css_uri = trailingslashit( $this->dir_uri . 'css' );
		$this->js_uri  = trailingslashit( $this->dir_uri . 'js'  );
	}

	private function includes() {

		// Load class files.
		require_once( $this->inc_dir . 'class-company.php'         );
		require_once( $this->inc_dir . 'class-company-factory.php' );

		// Load includes files.
		require_once( $this->inc_dir . 'functions-companies.php');


		// Load admin files.
		if ( is_admin() ) {
			// General admin functions.
			require_once( $this->admin_dir . 'functions-admin.php' );

			// Company management.
			require_once( $this->admin_dir . 'class-manage-companies.php');
			require_once( $this->admin_dir . 'class-companies.php');
			// require_once( $this->admin_dir . 'class-company-edit.php'             );
			require_once( $this->admin_dir . 'class-company-new.php'              );

			// Edit capabilities tabs and groups.
		}
	}

	private function setup_actions() {
		return;
	}

}

function ioc_management_plugin() {
	return IOC_Management_Plugin::get_instance();
}

// Let's roll!
ioc_management_plugin();
