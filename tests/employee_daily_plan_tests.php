<?php
    /* Gitaş - Obarey Inc. 2018 */

	require '../inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployeeDailyPlanDefinition.php";
	require CLASS_DIR . "GPEmployeeDailyPlanSchema.php";
	require CLASS_DIR . "GPEmployeeDailyPlan.php";
    require CLASS_DIR . "GPEmployee.php";


	function definePlan(){

	    $Employee = new GPEmployee(1);
	    $exInput = array(
            "daily_plan_schema_id" => 1,
            "daily_plan" => array(
                array( "plan_order" => 1, "start" => "08:00", "end" => "09:00", "employee_id" => 1, "status" => "B", "active_date" => "2018-06-18" ),
                array( "plan_order" => 2, "start" => "09:00", "end" => "10:00", "employee_id" => 1, "status" => "B", "active_date" => "2018-06-18" ),
                array( "plan_order" => 3, "start" => "10:00", "end" => "11:00", "employee_id" => 1, "status" => "B", "active_date" => "2018-06-18" )
            )
        );
	    $Employee->definePlan( $exInput );

    }

	function main(){
        definePlan();


    }


    echo '<pre>';

	main();
