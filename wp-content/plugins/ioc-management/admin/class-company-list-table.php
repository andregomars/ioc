<?php
/**
 * Handles the companies table on the Companies admin screen.
 */
class IOC_Company_List_Table extends WP_List_Table {

	/**
	 * The current view.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $company_view = 'all';

	/**
	 * Allowed role views.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $allowed_company_views = array();

	/**
	 * The default role.  This will be assigned the value of `get_option( 'default_role' )`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $default_company = 'io control';

	/**
	 * The current user object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    object
	 */
	public $current_user = '';

	/**
	 * Sets up the list table.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		$args = array(
			'plural'   => 'companies',
			'singular' => 'company',
		);

		parent::__construct( $args );

		// Get the current user object.
		$this->current_user = new WP_User( get_current_user_id() );

		// Get the role views.
		$this->allowed_company_views = array_keys( $this->get_views() );

		// Get the current view.
		if ( isset( $_GET['company_view'] ) && in_array( $_GET['company_view'], $this->allowed_company_views ) )
			$this->company_view = $_GET['company_view'];
	}

	/**
	 * Sets up the items (roles) to list.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function prepare_items() {
		global $wpapi;

		//$companies = json_encode($wpapi->get_all_company_names());
		$company_names = $wpapi->get_all_company_names();

		// Set up some current page variables.
		$items        = $company_names;
		$total_count  = count( $items );

		// Set the current page items.
		$this->items = $items;

		// Set the pagination arguments.
		$this->set_pagination_args( array( 'total_items' => $total_count, 'per_page' => $total_count ) );
	}

	/**
	 * Returns an array of columns to show.
	 *
	 * @see    members_manage_roles_columns()
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_columns() {
		return get_column_headers( $this->screen );
	}


	/**
	 * The checkbox column callback.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  string     $role
	 * @return string
	 */
	protected function column_cb( $company_id ) {
		return null;

		// $out = sprintf( '<input type="checkbox" name="companies[%1$s]" value="%1$s" />', esc_attr( $company ) );

		// return $out;
	}

	protected function column_title( $company_id ) {

		return sprintf( '<strong><a class="row-title">%s</a></strong>', esc_html( ioc_get_company_name( $company_id ) ) );
	}

	protected function column_id( $company_id ) {

		return $company_id;
	}

	protected function column_type( $company_id ) {

		return sprintf( '%s', esc_html( ioc_get_company_type( $company_id ) ) );
	}

	protected function column_address( $company_id ) {

		return sprintf( '%s', esc_html( ioc_get_company_address( $company_id ) ) );
	}

	protected function column_city( $company_id ) {

		return sprintf( '%s', esc_html( ioc_get_company_city( $company_id ) ) );
	}

	protected function column_state( $company_id ) {

		return sprintf( '%s', esc_html( ioc_get_company_state( $company_id ) ) );
	}

	protected function column_zipcode( $company_id ) {

		return sprintf( '%s', esc_html( ioc_get_company_zipcode( $company_id ) ) );
	}

	protected function column_fax( $company_id ) {

		return sprintf( '%s', esc_html( ioc_get_company_fax( $company_id ) ) );
	}

	protected function column_tel( $company_id ) {

		return sprintf( '%s', esc_html( ioc_get_company_tel( $company_id ) ) );
	}
	/**
	 * Returns the name of the primary column.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function get_default_primary_column_name() {
		return 'title';
	}

	/**
	 * Handles the row actions.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @param  string     $role
	 * @param  string     $column_name
	 * @param  string     $primary
	 * @return array
	 */
	protected function handle_row_actions( $company, $column_name, $primary ) {

		$actions = array();

		// Only add row actions on the primary column (title/role name).
		if ( $primary === $column_name ) {

			$actions['delete'] = sprintf( '<a href="%s">%s</a>', '#', 'Delete' );

		}

		return $this->row_actions( $actions );
	}

	/**
	 * Returns an array of sortable columns.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return array
	 */
	protected function get_sortable_columns() {
		return array();
	}

	/**
	 * Returns an array of views for the list table.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return array
	 */
	protected function get_views() {

		return array();
	}

	/**
	 * Displays the list table.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function display() {

		$this->views();

		parent::display();
	}

	/**
	 * Returns an array of bulk actions available.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return array
	 */
	protected function get_bulk_actions() {
		return array();
	}
}
