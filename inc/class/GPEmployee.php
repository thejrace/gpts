<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployee - base employee class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/
	class GPEmployee extends GPDataCommon {

		public function __construct( $val = null ){
			parent::__construct( DBT_GPEMPLOYEES, array( "id", "name", "nick", "email"), $val );
			$this->apiTriggerKey = "nick";
			$this->apiTriggerType = 1;
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
                "has_task" => array(
                    "label" 		=> "Görev Tanımlı"
                )
			);
		}

		/*
		 *  define the given plan schema to employee
		 *  @dailyPlanArray : array containing array of daily plan input data and dailyPlanSchema ID
		 *     dividing DailyPlanSchema into DailyPlan objects done on the clients program
		 *     we just add them to DB on serverside
		 * */
		public function definePlan( $dailyPlanArray ){
            // check daily plan schema
            $DailyPlanSchema = new GPEmployeeDailyPlanSchema( $dailyPlanArray["daily_plan_schema_id"] );
            if( !$DailyPlanSchema->getStatusFlag() ){
                $this->returnText = $DailyPlanSchema->getReturnText();
                return false;
            }
            // disable old definitions
            $this->removeOldPlanDefinitions();
            // define plan schema to employee
            $DailyPlanDef = new GPEmployeeDailyPlanDefinition;
            $DailyPlanDef->add(array(
                "employee_id"           => $this->details["id"],
                "daily_plan_schema_id"  => $DailyPlanSchema->getDetails("id"),
                "date_added"            => Common::getCurrentDate(),
                "status"                => 1
            ));
            // define plan items
            foreach( $dailyPlanArray["daily_plan"] as $dailyPlanInputItem ){
                $DailyPlan = new GPEmployeeDailyPlan;
                if( $DailyPlan->add( $dailyPlanInputItem ) ){
                    $this->returnText = $DailyPlan->getReturnText();
                    return false;
                }
            }
            $this->returnText = "İşlem tamamlandı.";
            return true;
        }

        /*
         *  - finds and disables old plan definitions
         * */
        private function removeOldPlanDefinitions(){
		    foreach( $this->getPlanDefinitions() as $planDef ){
		        $DailyPlanDef = new GPEmployeeDailyPlanDefinition( $planDef["id"] );
		        if( $DailyPlanDef->getStatusFlag() ){
		            $DailyPlanDef->editCol(array(
		                "status" => "0"
                    ));
                }
            }
        }

        /*
         *  - get plans defined to the employee
         *    @status : optional status where condition
         * */
        public function getPlanDefinitions( $status = null ){
            if( isset($status) ){
                return $this->pdo->query("SELECT * FROM " . DBT_GPEMPLOYEEDAILYPLANDEFINITIONS . " WHERE employee_id = ? && status = ?", array( $this->details["id"], $status ) )->results();
            } else {
                return $this->pdo->query("SELECT * FROM " . DBT_GPEMPLOYEEDAILYPLANDEFINITIONS . " WHERE employee_id = ?", array( $this->details["id"] ) )->results();
            }

        }

	}