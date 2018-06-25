<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployeeGroup - base employee group class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/

	class GPEmployeeGroup extends GPDataCommon {

		public function __construct( $val = null ){
			parent::__construct( DBT_GPEMPLOYEEGROUPS, array( "id", "name" ), $val );
            $this->apiTriggerKey = "name";
            $this->apiTriggerType = 3;
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