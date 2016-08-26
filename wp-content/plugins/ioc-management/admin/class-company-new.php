<?php

final class IOC_Admin_Company_New {

	/**
	 * Holds the instances of this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    object
	 */
	private static $instance;

	/**
	 * Name of the page we've created.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $page = '';

	/**
	 * Role that's being created.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $company_id;

	/**
	 * Name of the role that's being created.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $company_name = '';

	/**
	 * Array of the role's capabilities.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $capabilities = array();

	/**
	 * Conditional to see if we're cloning a role.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    bool
	 */
	public $is_clone = false;

	/**
	 * Role that is being cloned.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $clone_role = '';

	/**
	 * Sets up our initial actions.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
	}

	/**
	 * Adds the roles page to the admin.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function add_admin_page() {

		$this->page = add_submenu_page( 'users.php', esc_html__( 'Add New Company', 'iocmanagement' ), esc_html__( 'Add New Company', 'iocmanagement' ), 'create_roles', 'company-new', array( $this, 'page' ) );

		// Let's roll if we have a page.
		if ( $this->page ) {
			add_action( "load-{$this->page}", array( $this, 'load'          ) );
		}
	}

	/**
	 * Checks posted data on load and performs actions if needed.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function load() {


		// Check if the current user can create roles and the form has been submitted.
		if ( current_user_can( 'create_roles' ) ) {

			// Sanitize the new role name/label. We just want to strip any tags here.
			if ( ! empty( $_POST['company_name'] ) )
				$this->company_name = wp_strip_all_tags( $_POST['txt_company_name'] );

			// Is duplicate?
			$is_duplicate = false;
			if ( ioc_company_exists( $this->company_id ) )
				$is_duplicate = true;

			// Add a new role with the data input.
			if ( $this->company_name && ! $is_duplicate ) {

				//add company throug API

				// Add role added message.
				add_settings_error( 'ioc_company_new', 'company_added', sprintf( esc_html__( 'The %s company has been created.', 'companies' ), $this->company_name ), 'updated' );
			}

			// Add error if there's no role.
			if ( ! $this->company_name )
				add_settings_error( 'ioc_company_new', 'no_company', esc_html__( 'You must enter a valid company.', 'companies' ) );

			// Add error if this is a duplicate role.
			if ( $is_duplicate )
				add_settings_error( 'ioc_company_new', 'duplicate_company', sprintf( esc_html__( 'The %s company already exists.', 'companies' ), $this->company_name ) );

		}

	}

	/**
	 * Outputs the page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page() { ?>

		<div class="wrap">

			<h1>Add New Company</h1>

			<div id="poststuff">

				<form name="form0" method="post" action="<?php echo esc_url( ioc_get_new_company_url() ); ?>">

					<div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? 1 : 2; ?>">

						<div id="post-body-content">
							<table class="form-table">
								<tr class="form-field form-required">
									<th scope="row"><label>Company Name</label></th>
									<td><input name="txt_company_name" type="text" id="txt_company_name" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Address</label></th>
									<td><input name="txt_address" type="text" id="txt_address" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>State</label></th>
									<td><input name="txt_state" type="text" id="txt_state" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>City</label></th>
									<td><input name="txt_city" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Zip Code</label></th>
									<td><input name="txt_city" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Fax</label></th>
									<td><input name="txt_city" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Tel</label></th>
									<td><input name="txt_city" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Description</label></th>
									<td><input name="txt_city" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr>
									<th scope="row"><label>Description</label></th>
									<td>
						        		<select name="dpl_company_type" id="dpl_company_type">
											<option value="2">IO</option>
											<option selected="selected" value="4">Transit</option>
											<option value="8">Builder</option>
										</select><br>
										<span class="description">Please select I/O Controls Company Type.</span>
						        	</td>
					        	</tr>
							</table>


							<?php submit_button( 'Add New Company', 'primary', 'addcompany', true, array( 'id' => 'createcompanysub' ) ); ?>


						</div><!-- #post-body-content -->



					</div><!-- #post-body -->
				</form>

			</div><!-- #poststuff -->

		</div><!-- .wrap -->

	<?php }


	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		if ( ! self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

IOC_Admin_Company_New::get_instance();
