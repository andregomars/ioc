<?php
/**
 * Handles the companies table on the Companies admin screen.
 */
class IOC_Company_List_Table extends WP_List_Table {


	public $company_view = 'all';

	public $allowed_company_views = array();

	public $default_company = 'io control';

	public function __construct() {

		$args = array(
			'plural'   => 'companies',
			'singular' => 'company',
		);

		parent::__construct( $args );

		$this->allowed_company_views = array_keys( $this->get_views() );

		// Get the current view.
		if ( isset( $_GET['company_view'] ) && in_array( $_GET['company_view'], $this->allowed_company_views ) )
			$this->company_view = $_GET['company_view'];
	}

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

	public function get_columns() {
		return get_column_headers( $this->screen );
	}

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


	protected function get_default_primary_column_name() {
		return 'title';
	}


	protected function handle_row_actions( $company_id, $column_name, $primary ) {

		$actions = array();

		// Only add row actions on the primary column (title/role name).
		if ( $primary === $column_name ) {

			$actions['delete'] = sprintf( '<a href="%s">%s</a>', ioc_get_delete_company_url( $company_id ), 'Delete' );

		}

		return $this->row_actions( $actions );
	}

	protected function get_sortable_columns() {
		return array();
	}

	protected function get_views() {

		return array();
	}

	public function display() {

		$this->views();

		parent::display();
	}

	protected function get_bulk_actions() {
		return array();
	}
}
