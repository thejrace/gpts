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

            // todo API TRIGGER??

            $this->returnText = GPFormValidation::$SUCCESS_MESSAGE;
            return true;
        }

        /*
         *  define given work_template to employee
         *    @name
         *    @details
         *    @sub_items_encoded
         *    @periodic_flag
         *    @start_date ( optional value = null )
         *    @due_date ( optional value = null )
         *    @time_length  ( optional value = null )
         *    @define_interval ( not optional when periodic flag is set )
         * */
        public function defineWork( $input ){

            /*$Template = new GPEmployeeWorkTemplate( $input["work_template_id"] );
            if( !$Template->getStatusFlag() ){
                $this->returnText = $Template->getReturnText();
                return false;
            }*/

            if( (bool)$input["periodic_flag"] ){

            } else {
                $insertArray = array(
                    "name"                  => $input["name"],
                    "details"               => $input["details"],
                    "sub_items_encoded"     => $input["sub_items_encoded"],
                    "status"                => GPEmployeeWork::$STATUS_ACTIVE,
                    "employee_id"           => $this->details["id"]
                );
                if( $input["start_date"] != "null" ){
                    $insertArray["date_added"] = $input["start_date"];
                    $insertArray["status"] = GPEmployeeWork::$STATUS_PENDING;
                }
                $Work = new GPEmployeeWork();
                if( !$Work->add( $insertArray ) ){
                    $this->returnText = $Work->getReturnText();
                    return false;
                }
                $this->returnText = $Work->getReturnText();
            }

            return true;
        }

        /*
         *  returns employee's sub employees for desktop application
         *  it's a fetch - search action
         * */
        public function getRelatedEmployeesForDesktopApp( $colsToFetch, $rrp, $startIndex ){
            // get related child employees' ID's to filter others out for SQL fetch
            $fetchParams = $this->prepareRelatedEmployeesSQL();
            $q = GPDBFetch::action(DBT_GPEMPLOYEES, $colsToFetch,
                array(
                    "limit" => $rrp,
                    "start_index" => $startIndex,
                    "order_by" => array("name ASC")
                ),
                array( "keys" => implode(" || ", $fetchParams[0]), "vals" => $fetchParams[1] )
            );
            foreach ($q as $key => $val) {
                if ($val["name"] == "Serpil Boyacıoğlu") {
                    $q[$key]["task_status"] = 1;
                } else if ($val["name"] == "Veli Konstantin") {
                    $q[$key]["task_status"] = 2;
                } else {
                    $q[$key]["task_status"] = 0;
                }
                $q[$key]["task_count"] = 3;
            }
            return $q;
        }

        /*
         *  returns employee's sub employees for desktop application's search action
         * */
        public function searchRelatedEmployeesForDesktopApp( $keyword, $colsToFetch, $rrp = null, $startIndex = null ){
            $fetchParams = $this->prepareRelatedEmployeesSQL();
            if( isset($rrp) && isset($startIndex) ){
                $q = GPDBFetch::search(DBT_GPEMPLOYEES, $colsToFetch,
                    array(
                        "limit" => $rrp,
                        "start_index" => $startIndex,
                        "order_by" => array("name ASC")
                    ),
                    array("key" => "name", "keyword" => $keyword),
                    array( "keys" => implode(" || ", $fetchParams[0]), "vals" => $fetchParams[1] ));
                foreach ($q as $key => $val) {
                    $q[$key]["task_status"] = 2;
                    $q[$key]["task_count"] = 3;
                    $q[$key]["group"] = "Filo Yönetim";
                }
            } else {
                $q = GPDBFetch::search(DBT_GPEMPLOYEES, $colsToFetch,
                    array(
                        "order_by" => array("name ASC")
                    ),
                    array( "key" => "name", "keyword" => $keyword ),
                    array( "keys" => implode(" || ", $fetchParams[0]), "vals" => $fetchParams[1] ));
            }
            return $q;
        }

        // common method to prepare parameters for GPDBFetch actions to download related employees
        private function prepareRelatedEmployeesSQL(){
            $childrenEmps = $this->pdo->query("SELECT child_employee FROM " . DBT_GPEMPLOYEERELATIONS . " WHERE parent_employee = ?", array( $this->details["id"]))->results();
            $whereKeys = array();
            $whereVals = array();
            foreach( $childrenEmps as $c ){
                $whereVals[] = $c["child_employee"];
                $whereKeys[] = " id = ? ";
            }
            return array( $whereKeys, $whereVals );
        }



        public function getWorksForDesktopApp( $colsToFetch, $rrp, $startIndex, $orderBy, $statusFilter ){
            $archiveFlag = false;
            // only active works are in main table, others are saved in archive table
            if( $statusFilter == GPEmployeeWork::$STATUS_ACTIVE ){
                $table = DBT_GPEMPLOYEEWORKS;
            } else {
                $table = DBT_GPEMPLOYEEWORKSARCHIVE;
                $archiveFlag = true;
                // add subitem cols here
                $colsToFetch[] = "sub_items";
            }
            $q = GPDBFetch::action($table, $colsToFetch,
                array(
                    "limit"         => $rrp,
                    "start_index"   => $startIndex,
                    "order_by"      => $orderBy
                ),
                array( "keys" => "employee_id = ? && status = ?", "vals" => array( $this->details["id"], $statusFilter ) )
            );
            return $this->addSubItemsToData( $archiveFlag, $q );
        }

        public function searchWorksForDekstopApp( $keyword, $colsToFetch, $rrp, $startIndex, $orderBy, $statusFilter ){
            $archiveFlag = false;
            if( $statusFilter == GPEmployeeWork::$STATUS_ACTIVE ){
                $table = DBT_GPEMPLOYEEWORKS;
            } else {
                $table = DBT_GPEMPLOYEEWORKSARCHIVE;
                $archiveFlag = true;
                // add subitem cols here
                $colsToFetch[] = "sub_items";
            }
            $q = GPDBFetch::search($table, $colsToFetch,
                array(
                    "limit"         => $rrp,
                    "start_index"   => $startIndex,
                    "order_by"      => $orderBy
                ),
                array("key" => "name", "keyword" => $keyword),
                array( "keys" => "employee_id = ? && status = ?", "vals" => array( $this->details["id"], $statusFilter ) )
            );
            return $this->addSubItemsToData( $archiveFlag, $q );
        }

        /*
         *  common method for searchWorksForDekstopApp and getWorksForDekstopApp to fetch subItems of workdata
         * */
        private function addSubItemsToData( $archiveFlag, $data ){
            if( $archiveFlag ){
                // sub items already in sub_items col as jsonarray
                foreach( $data as $index => $workItem ){
                    // decode json array to avoid twice encoding when outputing data
                    $workItem["sub_items"] = json_decode($workItem["sub_items"], true);
                    $data[$index] = $workItem;
                }
            } else {
                // fetch sub items and add them to output array
                foreach( $data as $index => $workItem ){
                    $GWork = new GPEmployeeWork();
                    foreach( $workItem as $key => $val ) $GWork->setDetails( $key, $val );
                    $GWork->fetchSubItems();
                    $workItem["sub_items"] = $GWork->getDetails("sub_items");
                    $data[$index] = $workItem;
                }
            }
            return $data;
        }

        // @DEPRECATED 15.09.2018
        private function getWorks( $settings, $whereClause = null ){
            $q = GPDBFetch::action(DBT_GPEMPLOYEEWORKS, array("id", "name", "details", "date_added", "status", "due_date", "date_last_modified"),
                $settings,
                $whereClause
            );
            // fetch sub items and add them to output array
            foreach( $q as $index => $workItem ){
                $GWork = new GPEmployeeWork();
                foreach( $workItem as $key => $val ) $GWork->setDetails( $key, $val );
                $GWork->fetchSubItems();
                $workItem["sub_items"] = $GWork->getDetails("sub_items");
                $q[$index] = $workItem;
            }
            return $q;
        }
        // @DEPRECATED 15.09.2018
        public function getActiveWorks(){
            return $this->getWorks(
                array(
                    "order_by" => array("id DESC")
                ),
                array(
                    "keys" => "status = ?",
                    "vals" => array(GPEmployeeWork::$STATUS_ACTIVE)
                )
            );
        }
        // @DEPRECATED 15.09.2018
        public function getLastWorks(){
            return $this->getWorks(
                array(
                    "order_by" => array("date_added ASC")
                )
            );
        }

	}