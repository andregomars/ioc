<?php

final class IOC_Company_Factory {


	public $companies = array();

	private function __construct() {}

	public function add_company( $company_id ) {

		if ( !isset( $this->companies[ $company_id ] ) ) {
			$this->companies[ $company_id ] = new IOC_Company( $company_id );
		}
	}

	public function get_company( $company_id ) {

		return isset( $this->companies[ $company_id ] ) ? $this->companies[ $company_id ] : null;
	}

	public function remove_company( $company_id ) {

		if ( isset( $this->companies[ $company_id ] ) )
			unset( $this->companies[ $company_id ] );
	}

	public function get_companies() {
		return $this->companies;
	}

	protected function setup_companies() {
		global $wpapi;

		$all = $wpapi->get_all_companies();
		foreach ( $all as $key => $value ) {
			$this->add_company( $value->CompanyId );
		}
	}


	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new IOC_Company_Factory;
			$instance->setup_companies();
		}

		return $instance;
	}
}
