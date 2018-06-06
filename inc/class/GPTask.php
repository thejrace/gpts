<?php
	
	/* GPTask - base task class
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		- GPSubTaskDefinition.php
	*/
	class GPTask extends GPDataCommon {

		public static $SINGLE = 1, $BUNDLE = 2;

		public function __construct( $val = null ){
			parent::__construct( DBT_GPTASKS, array( "id", "name" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"name" => array(
					"label" 		=> "İsim",
					"unique"		=> true,
					"validation" 	=> array( "req" => true )
				),
				"group_id" => array(
					"label" 		=> "Grup",
					"validation" 	=> array( "req" => true, "posnum" => true )
				),
				"type" => array(
					"label" 		=> "Tip",
					"validation" 	=> array( "req" => true, "posnum" => true  )
				),
				"definition" => array(
					"label" 		=> "Açıklama"
				)
			);
		}

		/*
		*   - find the subtasks of task
		*   - returns an array containing GPTask objects
		*
		*/
		public function getSubTasks(){
			$this->details["sub_tasks"] = array();
			foreach( $this->pdo->query("SELECT task_id, task_order FROM " . DBT_GPSUBTASKDEFINITIONS .  " WHERE parent_task_id = ? ORDER BY task_order", array($this->details["id"] ))->results() as $res ){
				$this->details["sub_tasks"][] = new GPTask( $res["task_id"] );
			}
		}

		public function edit( $input ){
			// init main edit function
			parent::edit( $input );
			if( !$this->getStatusFlag() ) return;
			if( $this->details["type"] == self::$BUNDLE ){
				// if bundle task is being edited, we do additional work for it's sub tasks

				// 1 - check if sub task is removed or edited
				// 2 - if it's removed, find definitions and edit the task_order' s accordingly

			}
		}

		/*
		*  - add method, only bundle task work is additionally added
		*
		*/
		public function add( $input ){
			// first add the task to the database
			parent::add( $input );
			if( !$this->getStatusFlag() ) return;
			// then we check for sub tasks
			if( $input["type"] == self::$BUNDLE ){
				// if a bundle task is being added,
				// we define sub tasks to it
				// subtasks recieved as a jsonarray, containing jsonobjects
				$taskOrder = 1;
				foreach( json_decode($input["sub_tasks"], true) as $dataArray ){
					if( isset($dataArray["id"] ) ){
						// user choose already existing task
						$SubTask = new GPTask( $dataArray["id"] );
						if( !$SubTask->getStatusFlag() ) continue; // todo: reversing the changes when there is an error
					} else {
						// user added a new one
						$SubTask = new GPTask;
						$SubTask->add(array(
							"name" 			=> $dataArray["name"],
							"group_id" 		=> $dataArray["group_id"],
							"type" 			=> self::$SINGLE,
							"definition" 	=> $dataArray["definition"]
						));
					}
					// define each subtask to parent task
					$SubTaskDef = new GPSubTaskDefinition;
					$SubTaskDef->add(array(
						"parent_task_id" => $this->details["id"],
						"task_id"		 => $SubTask->getDetails("id"),
						"task_order"	 => $taskOrder
					));
					$taskOrder++;
				}
			}
		}

		
	}