<?php

	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployee.php";
	require CLASS_DIR . "GPTask.php";
	require CLASS_DIR . "GPEmployeeTaskDefinition.php";
	require CLASS_DIR . "GPEmployeeTaskDefinitionStatusUpdate.php";

	/* 
	* Task Definition Tests - Obarey Inc.
	* 	06.06.2018
	*/

	function addTest(){
		
		$Def = new GPEmployeeTaskDefinition;
		$Def->add(array(
			"employee_id" 		=> 1,
			"task_id" 			=> 2,
			"start" 			=> Common::getCurrentDatetime(),
			"time_length" 		=> 10,
			"date_added"	 	=> Common::getCurrentDatetime(),
			"date_last_update" 	=> Common::getCurrentDatetime(),
			"added_employee" 	=> 1

		));
		var_dump( $Def->getStatusFlag());
		echo "<br>" . $Def->getReturnText(); 
	}

	function fetchTest(){
		

		echo "<br>" . $Employee->getReturnText(); 
		print_r( $Employee->getDetails() );
	}

	function editTest(){
		

		var_dump( $Employee->getStatusFlag() );
		echo "<br>" . $Employee->getReturnText(); 

	}

	function deleteTest(){
		

		var_dump( $Employee->getStatusFlag() );
		echo "<br>" . $Employee->getReturnText(); 
	}

	function main(){
		echo '<pre>';
		addTest();
		//fetchTest();
		//editTest();
		//deleteTest();
	}

	main();

	
	