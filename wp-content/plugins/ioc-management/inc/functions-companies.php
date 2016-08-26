<?php 

function ioc_get_company_name( $company_id ) {
	$company_name = 'Unknown';
	switch ($company_id) {
		case 21:
			$company_name = 'I/O Controls Corporation';
			break;
		case 22:
			$company_name = 'LBT';
			break;
		case 23:
			$company_name = 'BYD';
			break;
		default:
			break;
	}

	return $company_name;
}

function ioc_get_company_type( $company_id ) {
	$company_type = 'Unknown';
	switch ($company_id) {
		case 21:
			$company_type = 'IO';
			break;
		case 22:
			$company_type = 'Transit';
			break;
		case 23:
			$company_type = 'Builder';
			break;
		default:
			break;
	}

	return $company_type;
}

function ioc_company_exists( $company_id ) {
	return in_array( $company_id, array(21, 22, 23) );
}