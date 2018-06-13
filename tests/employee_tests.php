<?php
    /* Gitaş - Obarey Inc. 2018 */
	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployee.php";

	function addTest(){
		$Employee = new GPEmployee;
		$Employee->add(array(
			"nick" 		=> "@eyup",
			"email" 	=> "eyup@test.com",
			"name" 		=> "Eyüp Bey",
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
		addTest();
		//fetchTest();
		//editTest();
		//deleteTest();
	}

	main();

	
	