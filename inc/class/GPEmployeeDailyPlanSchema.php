<?php
	
	/* GPEmployeeDailyPlanSchema - base employee daily plan schema data class
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/
	class GPEmployeeDailyPlanSchema extends GPDataCommon {
		public function __construct( $val = null ){
			parent::__construct( DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array( "id" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"name" => array(
					"label" 		=> "İsim",
					"validation" 	=> array( "req" => true, "unique" => true )
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
					"label" 		=> "Tanımlanma Sıklığı",
					"validation" 	=> array( "req" => true, "posnum" => true )
				),
			);
		}
	}