<?php 


function ioc_company_factory() {
	return IOC_Company_Factory::get_instance();
}

function ioc_get_company_name( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->name;
}

function ioc_get_company_type( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->type_name;
}

function ioc_get_company_description( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->description;
}

function ioc_get_company_address( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->address;
}

function ioc_get_company_city( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->city;
}

function ioc_get_company_state( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->state;
}

function ioc_get_company_zipcode( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->zipcode;
}

function ioc_get_company_fax( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->fax;
}

function ioc_get_company_tel( $company_id ) {
	return ioc_company_factory()->get_company( $company_id )->tel;
}

function ioc_company_exists( $company_name ) {
	global $wpapi;

	if ( !$company_name ) 
		return false;

	$company_names = $wpapi->get_all_company_names();
	foreach ( $company_names as $key=>$value ) {
		if ( strcasecmp( $company_name , $key ) === 0 )
			return true;
	}

	return false;
}

function ioc_company_id_exists( $company_id ) {
	global $wpapi;

	if ( is_null( $company_id ) ) 
		return false;

	$company = $wpapi->get_company( $company_id );

	return !is_null( $company );
}


function ioc_get_delete_company_url( $company_id ) {
	$url = add_query_arg( array( 'action' => 'delete', 'company_id' => $company_id ), ioc_get_edit_companies_url() );

	return wp_nonce_url( $url, 'delete_company', 'ioc_delete_company_nonce' );
}
