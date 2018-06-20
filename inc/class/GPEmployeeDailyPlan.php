<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployeeDailyPlan - base employee daily plan data class
	*     this class represents a row of a DailyPlanSchema, like ORER row for employee
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/
	class GPEmployeeDailyPlan extends GPDataCommon {
		public function __construct( $val = null ){
			parent::__construct( DBT_GPEMPLOYEEDAILYPLANS, array( "id" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"employee_id" => array(
					"label" 		=> "Personel ID",
					"validation" 	=> array( "req" => true )
				),
				"active_date" => array(
					"label" 		=> "Tarih",
					"validation" 	=> array( "req" => true )
				),
				"plan_order" => array(
					"label" 		=> "Sıra",
					"validation" 	=> array( "req" => true, "posnum" => true )
				),
				"start" => array(
					"label" 		=> "Başlangıç",
					"validation" 	=> array( "req" => true  )
				),
				"end" => array(
					"label" 		=> "Bitiş",
					"validation" 	=> array( "req" => true )
				),
                "stats" => array(
                    "label" 		=> "Bitiş"
                ),
                "edited" => array(
                    "label" 		=> "Bitiş"
                )
			);
		}
	}