<?php
	
	/* GPTaskGroup - base task group class
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- GPDataCommon.php
	*/

	class GPTaskGroup extends GPDataCommon {
		public function __construct( $val = null ){
			parent::__construct( DBT_GPTASKGROUPS, array( "id", "name" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"name" => array(
					"label" 		=> "İsim",
					"unique"		=> true,
					"validation" 	=> array( "req" => true )
				)
			);
		}


	}