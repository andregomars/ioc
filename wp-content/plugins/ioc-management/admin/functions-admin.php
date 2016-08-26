<?php


/**
 * Returns the URL for the add-new role admin screen.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function ioc_get_new_company_url() {
	return add_query_arg( 'page', 'company-new', admin_url( 'users.php' ) );
}


/**
 * Returns the URL for the edit roles admin screen.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function ioc_get_edit_companies_url() {
	return add_query_arg( 'page', 'companies', admin_url( 'users.php' ) );
}

/**
 * Returns the URL for the edit role admin screen.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $role
 * @return string
 */
function ioc_get_edit_company_url( $company ) {
	return add_query_arg( array( 'action' => 'edit', 'company' => $company ), ioc_get_edit_companies_url() );
}
