<?php

	/* GPEmployee - base employee class
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/
	class GPEmployee extends GPDataCommon {
		
		public function __construct( $val = null ){
			parent::__construct( DBT_GPEMPLOYEES, array( "id", "name", "nick", "email"), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"nick" => array(
					"label" 		=> "Rumuz",
					"unique"		=> true,
					"validation" 	=> array( "req" => true )
				),
				"email" => array(
					"label" 		=> "Eposta",
					"unique" => true,
					"validation" 	=> array( "req" => true, "email" => true )
				),
				"name" => array(
					"label" 		=> "İsim",
					"validation" 	=> array( "req" => true )
				),
				"group_id" => array(
					"label" 		=> "Grup",
					"validation" 	=> array( "req" => true, "posnum" => true )
				),
				"password" => array(
					"label" 		=> "Şifre",
					"validation" 	=> array( "req" => true )
				)
			);
		}



	}