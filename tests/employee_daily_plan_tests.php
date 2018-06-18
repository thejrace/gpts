<?php
    /* Gitaş - Obarey Inc. 2018 */

	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployee.php";
	require CLASS_DIR . "GPEmployeeDailyPlanSchema.php";
	require CLASS_DIR . "GPEmployeeDailyPlan.php";


	function definePlan(){

	    $Employee = new GPEmployee(1);
	    $exInput = array(



        );

	    $Employee->definePlan( $PlanSchema );

    }

	function main(){



    }


    echo '<pre>';

	main();
