<?php

	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPTask.php";
	require CLASS_DIR . "GPTaskGroup.php";
	require CLASS_DIR . "GPSubTaskDefinition.php";

	/* 
	* Task Tests - Obarey Inc.
	* 	06.06.2018
	*/
	class TaskTest {
		public static function addTest(){
			$Task = new GPTask;
			$Task->add(array(
				"name" => "Paket iş",
				"group_id" => 3,
				"type" => 1,
				"definition" => "test defs",
			));
			var_dump( $Task->getStatusFlag());
			echo "<br>" . $Task->getReturnText(); 
		}

		public static function editTest(){
			$Task = new GPTask(2);
			$Task->edit(array(
				"name" => "Test iş tanımı2 edited",
			));
			var_dump( $EmployeeGroup->getStatusFlag());
			echo "<br>" . $EmployeeGroup->getReturnText();
		}

		public static function fetchTest(){
			$Task = new GPTask(2);
			echo "<br>" . $Task->getReturnText(); 
			print_r( $Task->getDetails() );
		}

		public static function deleteTest(){
			$Task = new GPTask(2);
			$Task->delete();
			var_dump( $Task->getStatusFlag());
			echo "<br>" . $Task->getReturnText();
		}

		public static function main(){
			//self::addTest();
			//self::fetchTest();
			//self::editTest();
			//self::deleteTest();
		}
	}

	class BundleTaskTest {

		public static function addTest(){
			$Task = new GPTask;
			$Task->add(array(
				"name" => "Paket iş 2 test",
				"group_id" => 3,
				"type" => 2,
				"definition" => "test defs",
				"sub_tasks" => '[ { "id":1 }, { "name" : "sub task test", "group_id":3, "definition" : "test def" }, { "name" : "sub task test2", "group_id":3, "definition" : "test def2" } ]'
			));
			var_dump( $Task->getStatusFlag());
			echo "<br>" . $Task->getReturnText(); 
		}

		public static function fetchTest(){
			$Task = new GPTask( 7 );
			$Task->getSubTasks();
			echo "<br>" . $Task->getReturnText(); 
			print_r( $Task->getDetails() );
		}

		public static function editTest(){
			// todo
		}

		public static function deleteTest(){
			$Task = new GPTask(7);
			$Task->softDelete();
			var_dump( $Task->getStatusFlag());
			echo "<br>" . $Task->getReturnText();
		}

		public static function main(){
			//self::addTest();
			//self::fetchTest();
			self::deleteTest();
		}

	}

	
	class TaskGroupTest {
		public static function addTest(){
			$TaskGroup = new GPTaskGroup;
			$TaskGroup->add(array(
				"name" => "Test task grup"
			));
			var_dump( $TaskGroup->getStatusFlag());
			echo "<br>" . $TaskGroup->getReturnText(); 
		}

		public static function editTest(){
			$TaskGroup = new GPTaskGroup(1);
			$TaskGroup->edit(array(
				"name" => "Test task grup edited",
			));
			var_dump( $TaskGroup->getStatusFlag());
			echo "<br>" . $TaskGroup->getReturnText();
		}

		public static function fetchTest(){
			$TaskGroup = new GPTaskGroup(1);
			echo "<br>" . $TaskGroup->getReturnText(); 
			print_r( $TaskGroup->getDetails() );
		}

		public static function deleteTest(){
			$TaskGroup = new GPTaskGroup(1);
			$TaskGroup->delete();
			var_dump( $TaskGroup->getStatusFlag());
			echo "<br>" . $TaskGroup->getReturnText();
		}

		public function main(){
			//self::addTest();
			//self::editTest();
			//self::fetchTest();
			//self::deleteTest();
		}

	}

	echo '<pre>';

	//TaskTest::main();
	BundleTaskTest::main();
	//TaskGroupTest::main();