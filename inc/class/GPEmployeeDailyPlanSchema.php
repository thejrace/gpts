<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployeeDailyPlanSchema - base employee daily plan schema data class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/
	class GPEmployeeDailyPlanSchema extends GPDataCommon {
		public function __construct( $val = null ){
			parent::__construct( DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array( "id" ), $val );
            $this->apiTriggerKey = "name";
            $this->apiTriggerType = 2;
			$this->dbFormKeys = array(
				"name" => array(
					"label" 		=> "İsim",
                    "unique"        => true,
					"validation" 	=> array( "req" => true )
				),
				"start" => array(
					"label" 		=> "Başlangıç",
					"validation" 	=> array( "req" => true  )
				),
				"end" => array(
					"label" 		=> "Bitiş",
					"validation" 	=> array( "req" => true )
				),
				"plan_interval" => array(
					"label" 		=> "Aralık",
					"validation" 	=> array( "req" => true, "posnum" => true )
				)
			);
		}
	}