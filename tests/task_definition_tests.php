<?php
    /* Gitaş - Obarey Inc. 2018 */
	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployee.php";
	require CLASS_DIR . "GPTask.php";
	require CLASS_DIR . "GPEmployeeTaskDefinition.php";
	require CLASS_DIR . "GPEmployeeTaskDefinitionStatusUpdate.php";

	function addTest(){
		
		$Def = new GPEmployeeTaskDefinition;
		$Def->add(array(
			"employee_id" 		=> 1,
			"task_id" 			=> 7,
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
		
		$Def = new GPEmployeeTaskDefinition(1);
		echo "<br>" . $Def->getReturnText(); 
		print_r( $Def->getDetails() );
	}

    function fetchArchiveTest(){

        $Def = new GPEmployeeTaskDefinition(18, true);
        echo "<br>" . $Def->getReturnText();
        print_r( $Def->getDetails() );
    }

	function editTest(){
		
		$Def = new GPEmployeeTaskDefinition(1);
		$Def->edit(array(
			"end" => Common::getCurrentDatetime(),
			"status" => 5
		));
		var_dump( $Def->getStatusFlag() );
		echo "<br>" . $Def->getReturnText(); 

	}

	function deleteTest(){
		// tested for both single and bundle task
		$Def = new GPEmployeeTaskDefinition(27);
		$Def->delete();
		var_dump( $Def->getStatusFlag() );
		echo "<br>" . $Def->getReturnText(); 
	}

	function archiveTest(){
        $Def = new GPEmployeeTaskDefinition(18);
        $Def->moveToArchiveTable();
        var_dump( $Def->getStatusFlag() );
        echo "<br>" . $Def->getReturnText();

    }

	function main(){
		echo '<pre>';
		//addTest();
		//fetchTest();
		fetchArchiveTest();
		//editTest();
		//deleteTest();
        //archiveTest();
	}

	main();

	
	