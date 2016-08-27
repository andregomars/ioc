<?php

class IOC_Company {

	public $id = 0;
	public $name = '';
	public $description = '';
	public $type_id = 0; 
	public $type_name = '';
	public $address = '';
	public $city = '';
	public $state = '';
	public $zipcode = '';
	
	public function __construct( $company_id ) {
		global $wpapi;

		$company = $wpapi->get_company( $company_id );

		if ( $company ) {
			$this->id = $company->CompanyId;
			$this->name = $company->Name;
			$this->description = $company->Description;
			$this->type_id = $company->CompanyType;
			$this->type_name = $this->get_company_type_name( $company->CompanyType );
			$this->address = $company->Address;
			$this->city = $company->City;
			$this->state = $company->State;
			$this->zipcode = $company->ZipCode;
			$this->fax = $company->Fax;
			$this->tel = $company->Tel;
		}
	}

	private function get_company_type_name ( $id ) {
		$name = '';

		switch ( $id ) {
			case 2: $name = 'IO'; break;
			case 4: $name = 'Transit'; break;
			case 8: $name = 'Builder'; break;
			default: $name = ''; break;
		}
		return $name;
	}
}
