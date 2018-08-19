<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployee - base employee class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/

	// todo Employee eklenince ApiUser olarakta bi kayıt yapılacak
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
				"employee_group" => array(
					"label" 		=> "Grup",
					"validation" 	=> array( "req" => true )
				),
                "phone_1" => array(
                    "label" 		=> "Tel 1"
                ),
                "phone_2" => array(
                    "label" 		=> "Tel 2"
                ),
                "has_task" => array(
                    "label" 		=> "Görev Tanımlı"
                )
			);
		}

		public function add( $input ){
		    $EmpGroup = new GPEmployeeGroup( $input["employee_group"]);
		    if( !$EmpGroup->getStatusFlag() ) return false;
		    // form submits employee_group's name, we convert it to id
		    $input["employee_group"] = $EmpGroup->getDetails("id");
		    // add the employee
		    if( !parent::add( $input ) ) return false;
		    // crate api_user account for employee
            $ApiUser = new GPApiUser();
            if( !$ApiUser->add(array(
                "email"         => $input["email"],
                "password"      => "gitas_".$input["email"], // default password
                "user_group"    => GPApiUser::$NORMAL, // add as a normal user
                "permissions"   => $EmpGroup->getDetails("permissions"), // inherit employee group's permissions
                "date_added"    => Common::getCurrentDateTime(),
                "status"        => 1
            ))){
                $this->returnText = $ApiUser->getReturnText();
                return false;
            }
            return true;
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

        /*
         *  adds sub employee relations to current object
         * */
        public function addRelation( $subEmployeeID ){
            // check if two employees have already related
            $Relation = new GPEmployeeRelation( $this->details["id"], $subEmployeeID );
            if( $Relation->getStatusFlag() ){
                $this->returnText = "Bu iki personel zaten ilişkilendirilmiş.";
                return false;
            }
            $Relation = new GPEmployeeRelation();
            if( !$Relation->add(array(
                "parent_employee"  => $this->details["id"],
                "child_employee"   => $subEmployeeID
            )) ){
                $this->returnText = $Relation->getReturnText();
                return false;
            }

            // todo API TRIGGER

            $this->returnText = GPFormValidation::$SUCCESS_MESSAGE;
            return true;
        }

        /*
         *  returns employee's sub employees as GPEmployee objects
         *  it's a fetch - search action
         *  todo GPDBFetch connect!!
         * */
        public function getRelations(){

        }

        public function searchRelations( $keyword ){

        }

	}