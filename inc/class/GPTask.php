<?php
	
	/* GPTask - base task class
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/
	class GPTask extends GPDataCommon {

		public static $SINGLE = 1, $BUNDLE = 2;

		public function __construct( $val = null ){
			parent::__construct( DBT_GPTASKS, array( "id", "name" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"name" => array(
					"label" 		=> "İsim",
					"unique"		=> true,
					"validation" 	=> array( "req" => true )
				),
				"group_id" => array(
					"label" 		=> "Grup",
					"validation" 	=> array( "req" => true, "posnum" => true )
				),
				"type" => array(
					"label" 		=> "Tip",
					"validation" 	=> array( "req" => true, "posnum" => true  )
				),
				"definition" => array(
					"label" 		=> "Açıklama"
				)
			);
		}
		
	}