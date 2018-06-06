<?php
	
	/* GPEmployeeTaskDefinition - base employee task definition class
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		- GPEmployee.php
	*		- GPTask.php
	*/

	class GPEmployeeTaskDefinition extends GPDataCommon {
	
		public function __construct( $val = null ){
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
					"label" 		=> "Durum",
					"validation" 	=> array( "posnum" => true )
				)
			);
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

			// add parent task or single task when task is single
			parent::add( $input );
			
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
					$input["parent_task_id"] = $input["task_id"];
					$input["task_id"] = $subTaskObject->getDetails("id");
					// add each task
					parent::add( $input );
				}
			}
		}
	}