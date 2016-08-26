<?php
/**
 * Companies admin screen.
 *
  */
final class IOC_Admin_Companies {

	/**
	 * Sets up some necessary actions/filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Set up some page options for the current screen.
		add_action( 'current_screen', array( $this, 'current_screen' ) );

		// Set up the role list table columns.
		add_filter( 'ioc_manage_companies_columns', array( $this, 'manage_companies_columns' ), 5 );

	}

	/**
	 * Modifies the current screen object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function current_screen( $screen ) {

		if ( 'users_page_roles' === $screen->id )
			$screen->add_option( 'per_page', array( 'default' => 20 ) );
	}

	/**
	 * Sets up the roles column headers.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $columns
	 * @return array
	 */
	public function manage_companies_columns( $columns ) {

		$columns = array(
			'cb'            => '<input type="checkbox" />',
			'title'         => esc_html__( 'Company Name', 'iocmanagement' ),
			'id'          => esc_html__( 'ID',      'iocmanagement' )
		);

		return apply_filters( 'ioc_manage_companies_columns', $columns );
	}

	/**
	 * Runs on the `load-{$page}` hook.  This is the handler for form submissions and requests.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function load() {

		// Get the current action if sent as request.
		$action = isset( $_REQUEST['action'] ) ? sanitize_key( $_REQUEST['action'] ) : false;


		// Delete single role handler.
		if ( 'delete' === $action ) {

			// Make sure the current user can delete roles.
			if ( current_user_can( 'delete_roles' ) ) {

				// Get the role we want to delete.
				$company = $_GET['company'] ;

				// Add role deleted message.
				add_settings_error( 'ioc_companies', 'company_deleted', sprintf( esc_html__( '%s company deleted.', 'iocmanagement' ), $company ), 'updated' );

				// Delete the role.
				//delete company
			}
		}

	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {

	}

	/**
	 * Displays the page content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page() {

		require_once( ioc_management_plugin()->admin_dir . 'class-company-list-table.php' ); ?>

		<div class="wrap">

			<h1>
				<?php esc_html_e( 'Companies', 'iocmanagement' ); ?>

				<?php if ( current_user_can( 'create_roles' ) ) : ?>
					<a href="<?php echo esc_url( ioc_get_new_company_url() ); ?>" class="page-title-action"><?php esc_html_e( 'Add New', 'iocmanagement' ); ?></a>
				<?php endif; ?>
			</h1>

			<div id="poststuff">

				<form id="roles" action="<?php echo esc_url( ioc_get_edit_companies_url() ); ?>" method="post">

					<?php $table = new IOC_Company_List_Table(); ?>
					<?php $table->prepare_items(); ?>
					<?php $table->display(); ?>

				</form><!-- #roles -->

			</div><!-- #poststuff -->

		</div><!-- .wrap -->
	<?php }



}
