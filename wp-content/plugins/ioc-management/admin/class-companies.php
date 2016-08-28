<?php
/**
 * Companies admin screen.
 *
  */
final class IOC_Admin_Companies {


	public function __construct() {

		// Set up some page options for the current screen.
		add_action( 'current_screen', array( $this, 'current_screen' ) );

		// Set up the role list table columns.
		add_filter( 'manage_users_page_companies_columns', array( $this, 'manage_companies_columns' ), 5 );

	}


	public function current_screen( $screen ) {

		if ( 'users_page_roles' === $screen->id )
			$screen->add_option( 'per_page', array( 'default' => 20 ) );
	}


	public function manage_companies_columns( $columns ) {

		$columns = array(
			//'cb'            => '<input type="checkbox" />',
			'title'         => esc_html__( 'Company Name', 'iocmanagement' ),
			'id'          => esc_html__( 'ID',      'iocmanagement' ),
			'type'          => esc_html__( 'Type',      'iocmanagement' ),
			'address'          => esc_html__( 'Address',      'iocmanagement' ),
			'city'          => esc_html__( 'City',      'iocmanagement' ),
			'state'          => esc_html__( 'State',      'iocmanagement' ),
			'zipcode'          => esc_html__( 'Zip Code',      'iocmanagement' ),
			'fax'          => esc_html__( 'Fax',      'iocmanagement' ),
			'tel'          => esc_html__( 'Tel',      'iocmanagement' )

		);

		return apply_filters( 'ioc_manage_companies_columns', $columns );
	}


	public function load() {

		// Get the current action if sent as request.
		$action = isset( $_REQUEST['action'] ) ? sanitize_key( $_REQUEST['action'] ) : false;


		// Delete single company handler.
		if ( 'delete' === $action ) {

			if ( current_user_can( 'delete_roles' ) ) {

				$company_id = $_GET['company_id'] ;

				if ( ioc_company_id_exists($company_id) ) {
					// Add company deleted message.
					add_settings_error( 'ioc_companies', 'company_deleted', sprintf( esc_html__( '%s company deleted.', 'iocmanagement' ), $company_id ), 'updated' );

					//Delete company
					ioc_delete_company( $company_id );
				}
			}
		}

	}


	public function enqueue() {

	}


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

				<form id="companies" action="<?php echo esc_url( ioc_get_edit_companies_url() ); ?>" method="post">

					<?php $table = new IOC_Company_List_Table(); ?>
					<?php $table->prepare_items(); ?>
					<?php $table->display(); ?>

				</form><!-- #companies -->

			</div><!-- #poststuff -->

		</div><!-- .wrap -->
	<?php }



}
