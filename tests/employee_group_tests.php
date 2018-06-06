<?php

	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployeeGroup.php";

	/* 
	* Employee Group Tests - Obarey Inc.
	* 	06.06.2018
	*/

	function addTest(){
		$EmployeeGroup = new GPEmployeeGroup;
		$EmployeeGroup->add(array(
			"name" => "Test grup"
		));
		var_dump( $EmployeeGroup->getStatusFlag());
		echo "<br>" . $EmployeeGroup->getReturnText(); 
	}

	function fetchTest(){
		$EmployeeGroup = new GPEmployeeGroup("Test grup");
		var_dump( $EmployeeGroup->getStatusFlag() );
		echo "<br>" . $EmployeeGroup->getReturnText(); 
		print_r( $EmployeeGroup->getDetails() );
	}

	function editTest(){
		$EmployeeGroup = new GPEmployeeGroup("Test grup");
		$EmployeeGroup->edit(array(
			"name" => "Test grup2"
		));
		var_dump( $EmployeeGroup->getStatusFlag());
		echo "<br>" . $EmployeeGroup->getReturnText();
	}

	function deleteTest(){
		$EmployeeGroup = new GPEmployeeGroup("Test grup");
		$EmployeeGroup->delete();
		var_dump( $EmployeeGroup->getStatusFlag());
		echo "<br>" . $EmployeeGroup->getReturnText();
	}

	function main(){
		///addTest();
		//fetchTest();
		//editTest();
		//deleteTest();
	}

	echo '<pre>';
	main();