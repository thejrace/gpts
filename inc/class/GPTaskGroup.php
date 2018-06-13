<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPTaskGroup - base task group class
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