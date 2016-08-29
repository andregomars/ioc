<?php

final class IOC_Admin_Company_New {

	private static $instance;

	public $page = '';

	public $company_id;

	public $company_name = '';

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_admin_page' ) );
	}

	public function add_admin_page() {

		$this->page = add_submenu_page( 'users.php', esc_html__( 'Add New Company', 'iocmanagement' ), esc_html__( 'Add New Company', 'iocmanagement' ), 'create_roles', 'company-new', array( $this, 'page' ) );

		// Let's roll if we have a page.
		if ( $this->page ) {
			add_action( "load-{$this->page}", array( $this, 'load'          ) );
		}
	}

	
	public function load() {

		if ( current_user_can( 'create_roles' ) ) {
			// Verify the nonce.
			//check_admin_referer( 'new_company', 'ioc_new_company_nonce' );

			if ( ! empty( $_POST['txt_company_name'] ) )
				$this->company_name = wp_strip_all_tags( $_POST['txt_company_name'] );

			$company_type = 0;
			$company_address = null;
			$company_city = null;
			$company_state = null;
			$company_zipcode = null;
			$company_fax = null;
			$company_tel = null;
			$company_description = null;

			if ( ! empty( $_POST['dpl_company_type'] ) ) {
				$company_type = wp_strip_all_tags( $_POST['dpl_company_type'] );
			}

			if ( ! empty( $_POST['txt_address'] ) )
				$company_address = wp_strip_all_tags( $_POST['txt_address'] );

			if ( ! empty( $_POST['txt_city'] ) )
				$company_city = wp_strip_all_tags( $_POST['txt_city'] );

			if ( ! empty( $_POST['txt_state'] ) )
				$company_state = wp_strip_all_tags( $_POST['txt_state'] );

			if ( ! empty( $_POST['txt_zipcode'] ) )
				$company_zipcode = wp_strip_all_tags( $_POST['txt_zipcode'] );

			if ( ! empty( $_POST['txt_fax'] ) )
				$company_fax = wp_strip_all_tags( $_POST['txt_fax'] );

			if ( ! empty( $_POST['txt_tel'] ) )
				$company_tel = wp_strip_all_tags( $_POST['txt_tel'] );

			if ( ! empty( $_POST['txt_description'] ) )
				$company_description = wp_strip_all_tags( $_POST['txt_description'] );

			// Is duplicate?
			$is_duplicate = false;
			if ( ioc_company_exists( $this->company_name ) )
				$is_duplicate = true;

			// Add a new company with the data input.
			if ( $this->company_name && ! $is_duplicate ) {

				//add company throug API
				$new_company = array (
					'Name' => $this->company_name,
					'CompanyType' => $company_type,
					'Address' => $company_address,
					'City' => $company_city,
					'State' => $company_state,
					'ZipCode' => $company_zipcode,
					'Fax' => $company_fax,
					'Tel' => $company_tel,
					'Description' => $company_description,
					'IsStop' => 0,
					'Status' => 0,
					'CreateTime' => date('c') );


				ioc_insert_company( $new_company );

				// Add company added message.
				add_settings_error( 'ioc_company_new', 'company_added', sprintf( esc_html__( 'The %s company has been created.', 'companies' ), $this->company_name ), 'updated' );
			}

			// Add error if there's no company.
			// if ( ! $this->company_name )
			// 	add_settings_error( 'ioc_company_new', 'no_company', esc_html__( 'You must enter a valid company.', 'companies' ) );

			// Add error if this is a duplicate company.
			if ( $is_duplicate ) {
				add_settings_error( 'ioc_company_new', 'duplicate_company', sprintf( esc_html__( 'The %s company already exists.', 'companies' ), $this->company_name ) );
			}

		}

	}

	public function page() { ?>

		<div class="wrap">

			<h1>Add New Company</h1>

			<?php settings_errors( 'ioc_company_new' ); ?>

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
									<td><input name="txt_zipcode" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Fax</label></th>
									<td><input name="txt_fax" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Tel</label></th>
									<td><input name="txt_tel" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr class="form-field form-required">
									<th scope="row"><label>Description</label></th>
									<td><input name="txt_description" type="text" id="txt_city" class="regular-text" /></td>
								</tr>
								<tr>
									<th scope="row"><label>Company Type</label></th>
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


	public static function get_instance() {

		if ( ! self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

IOC_Admin_Company_New::get_instance();
