<?php

	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployee.php";

	/* 
	* Employee Tests - Obarey Inc.
	* 	06.06.2018
	*/

	function addTest(){
		$Employee = new GPEmployee;
		$Employee->add(array(
			"nick" 		=> "@obarey",
			"email" 	=> "test@test.com",
			"name" 		=> "Obarey Inc.",
			"group_id" 	=> 2,
			"password" 	=> "wazzabii"
		));
		var_dump( $Employee->getStatusFlag());
		echo "<br>" . $Employee->getReturnText(); 
	}

	function fetchTest(){
		$Employee = new GPEmployee( "test@test.com" );
		var_dump( $Employee->getStatusFlag() );
		echo "<br>" . $Employee->getReturnText(); 
		print_r( $Employee->getDetails() );
	}

	function editTest(){
		$Employee = new GPEmployee( "test@test.com" );
		$Employee->edit( array(
			"nick"	 => "@obarey_edited2",
			"email" => "testt@testt.com",
			"name" 	=> "Obarey Inc. edited"
		));
		var_dump( $Employee->getStatusFlag() );
		echo "<br>" . $Employee->getReturnText(); 

	}

	function deleteTest(){
		$Employee = new GPEmployee( "test@test.com" );
		$Employee->delete();
		var_dump( $Employee->getStatusFlag() );
		echo "<br>" . $Employee->getReturnText(); 
	}

	function main(){
		echo '<pre>';
		//addTest();
		//fetchTest();
		//editTest();
		//deleteTest();
	}

	main();

	
	