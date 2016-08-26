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

	/**
	 * Plugin directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_path = '';

	/**
	 * Plugin directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir_uri = '';

	/**
	 * Plugin admin directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $admin_dir = '';

	/**
	 * Plugin includes directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $inc_dir = '';

	/**
	 * Plugin templates directory path.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $templates_dir = '';

	/**
	 * Plugin CSS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $css_uri = '';

	/**
	 * Plugin JS directory URI.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $js_uri = '';

	/**
	 * User count of all roles.
	 *
	 * @see    members_get_role_user_count()
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $role_user_count = array();

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
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

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Magic method to output a string if trying to use the object as a string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __toString() {
		return 'iocmanagement';
	}


	/**
	 * Sets up globals.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
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

	/**
	 * Loads files needed by the plugin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function includes() {

		// Load class files.
		// require_once( $this->inc_dir . 'class-role.php'         );
		// require_once( $this->inc_dir . 'class-role-factory.php' );

		// Load template files.
		// require_once( $this->inc_dir . 'template.php' );

		// Load admin files.
		if ( is_admin() ) {
			// General admin functions.
			require_once( $this->admin_dir . 'functions-admin.php' );

			// Role management.
			require_once( $this->admin_dir . 'class-manage-companies.php'          );
			require_once( $this->admin_dir . 'class-companies.php'                 );
			// require_once( $this->admin_dir . 'class-company-edit.php'             );
			// require_once( $this->admin_dir . 'class-company-new.php'              );

			// Edit capabilities tabs and groups.
		}
	}

	/**
	 * Sets up main plugin actions and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function setup_actions() {
		return;
	}

}

/**
 * Gets the instance of the `Members_Plugin` class.  This function is useful for quickly grabbing data
 * used throughout the plugin.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function ioc_management_plugin() {
	return IOC_Management_Plugin::get_instance();
}

// Let's roll!
ioc_management_plugin();
