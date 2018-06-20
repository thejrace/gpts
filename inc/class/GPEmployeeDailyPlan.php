<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployeeDailyPlan - base employee daily plan data class
	*     this class represents a row of a DailyPlanSchema, like ORER row for employee
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/
	class GPEmployeeDailyPlan extends GPDataCommon {
		public function __construct( $val = null, $archive = false ){
            if( isset($val) && isset($archive) && $archive ) $this->archiveFlag = true;
			parent::__construct( DBT_GPEMPLOYEEDAILYPLANS, array( "id" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"employee_id" => array(
					"label" 		=> "Personel ID",
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
                "status" => array(
                    "label" 		=> "Durum"
                ),
                "status_code" => array(
                    "label" 		=> "Durum Kodu"
                ),
                "edited" => array(
                    "label" 		=> "Düzenlendi"
                )
			);
		}
	}