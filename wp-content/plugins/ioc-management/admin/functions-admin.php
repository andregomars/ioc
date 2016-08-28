<?php


function ioc_get_new_company_url() {
	return add_query_arg( 'page', 'company-new', admin_url( 'users.php' ) );
}


function ioc_get_edit_companies_url() {
	return add_query_arg( 'page', 'companies', admin_url( 'users.php' ) );
}

function ioc_get_edit_company_url( $company ) {
	return add_query_arg( array( 'action' => 'edit', 'company' => $company ), ioc_get_edit_companies_url() );
}

function ioc_delete_company( $company_id ) {
	global $wpapi;
	
	$wpapi->delete_company( $company_id );
	ioc_company_factory()->remove_company( $company_id );
}

function ioc_insert_company( $company ) {
	global $wpapi;
	
	$new_company = $wpapi->insert_company( $company );
	if ( isset($new_company) ) {
		ioc_company_factory()->add_company( $new_company->CompanyId );
	}
}