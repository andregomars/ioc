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
		if ( strcmp( $company_name , $key ) === 0 )
			return true;
	}

	return false;
}