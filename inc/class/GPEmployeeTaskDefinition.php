<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployeeTaskDefinition - base employee task definition class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		- GPEmployee.php
	*		- GPTask.php
	*/

	class GPEmployeeTaskDefinition extends GPDataCommon {
	
		public function __construct( $val = null, $archive = false ){
		    if( isset($val) && isset($archive) && $archive ) $this->archiveFlag = true;
            $this->archiveTable = DBT_GPEMPLOYEETASKDEFINITIONSARCHIVE;
			parent::__construct( DBT_GPEMPLOYEETASKDEFINITIONS, array( "id" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"employee_id" => array(
					"label" 		=> "Personel ID",
					"validation" 	=> array( "req" => true )
				),
				"task_id" => array(
					"label" 		=> "İş ID",
					"validation" 	=> array( "req" => true )
				),
				"start" => array(
					"label" 		=> "Başlangıç",
					"validation" 	=> array( "req" => true  )
				),
				"time_length" => array(
					"label" 		=> "Süre",
					"validation" 	=> array( "req" => true, "posnum" => true  )
				),
				"end" => array(
					"label" 		=> "Bitiş",
					"validation" 	=> array( "req" => true )
				),
				"date_added" => array(
					"label" 		=> "Eklenme Tarihi",
					"validation" 	=> array( "req" => true  )
				),
				"date_last_update" => array(
					"label" 		=> "Son Güncellenme Tarihi",
					"validation" 	=> array( "req" => true )
				),
				"added_employee" => array(
					"label" 		=> "Ekleyen",
					"validation" 	=> array( "req" => true )
				),
				"status" => array(
					"label" 		=> "Durum"
				),
                "comments" => array(
                    "label" 		=> "Yorumlar"
                ),
				"parent_definition_id" => array(
					"label" 		=> "Üst Tanımlama ID",
					"validation" 	=> array( "posnum" => true )
				),
                "deleted" => array(
                    "label" 		=> "Silinmiş"
                )
			);
		}

		/**
		* - delete method, super() + if task type is bundle, additionally delete the sub task definitions
		*
		*/
		public function delete(){
			// search for any sub task definitions and delete them
			foreach( $this->pdo->query("SELECT * FROM " . $this->table . " WHERE parent_definition_id = ?", array( $this->details["id"]))->results() as $res ){
				$Def = new GPEmployeeTaskDefinition( $res["id"] );
				$Def->delete();
			}
			// delete definition at last to keep details array 
			parent::delete();
			if( !$this->getStatusFlag() ) return;
		}

		/*
		*  add method, but we override it due to additional work needs to be done on it
		*/
		public function add( $input ){
			// check the employee
			$Employee = new GPEmployee( $input["employee_id"]);
			if( !$Employee->getStatusFlag() ){
				$this->returnText = $Employee->getReturnText();
				return;
			}
			// check the task that wanted to be defined to the employee
			$ParentTask = new GPTask( $input["task_id"] );
			if( !$ParentTask->getStatusFlag() ){
				$this->returnText = $ParentTask->getReturnText();
				return;
			}

			// TODO: check if task is already defined to the employee

			// add parent task or single task when task is single
			parent::add( $input );
			$parentTaskID = $this->details["id"];
			if( $ParentTask->getDetails("type") == GPTask::$BUNDLE ){
				// bundle task, which means we need to add all sub tasks to the user,
				// in addition to the bundle task
				// find the sub tasks
				$ParentTask->getSubTasks();
				foreach( $ParentTask->getDetails("sub_tasks") as $subTaskObject ){
					$SubTask = new GPTask( $subTaskObject->getDetails("id") );
					if( !$SubTask->getStatusFlag() ){
						$SubTask->returnText = $ParentTask->getReturnText();
						return;
					}
					// override the input values for sub task addition
					$input["parent_definition_id"] = $parentTaskID;
					$input["task_id"] = $subTaskObject->getDetails("id");
					// add each task
					parent::add( $input );
				}
			}
			// raise employee's has_task flag
			$Employee->editCol(array( "has_task" => 1 ));
		}


		/*
		 *  - parent method + archives status update records defined to the task definition
		 * */
		public function moveToArchiveTable(){
            parent::moveToArchiveTable();
            if( !$this->ok ) return;
            // reset status flag and text
            $this->ok = false;
            $this->returnText = "";
            // archive all status updates
            $query = $this->pdo->query("SELECT id FROM " . DBT_GPEMPLOYEETASKDEFINITIONSSTATUSUPDATES . " WHERE work_task_definition_id = ?", array( $this->details["id"] ))->results();
            foreach( $query as $res ){
                $StatusUpdate = new GPEmployeeTaskDefinitionStatusUpdate( $res["id"] );
                // if update is not found for some reason, dont break the loop
                if( !$StatusUpdate->ok ) continue;
                $StatusUpdate->moveToArchiveTable();
            }
            $this->returnText = "İşlem tamamlandı.";
            $this->ok = true;
        }

    }