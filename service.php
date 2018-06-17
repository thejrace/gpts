<?php
    /* Gitaş - Obarey Inc. 2018 */
    /* main web service */
	require 'inc/defs.php';

	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployee.php";

	if( $_POST ){

		$OK = 1;
		$TEXT = "";
		$DATA = array();

		switch( $_POST["req"] ){

			// test
			case 'employees_download':

				$q = DB::getInstance()->query("SELECT id, name, email, group_id, nick FROM " . DBT_GPEMPLOYEES )->results();
				foreach( $q as $key => $val ){

					if( $val["name"] == "Serpil Boyacıoğlu" ){
						$q[$key]["task_status"] = 1;
					} else if( $val["name"] == "Veli Konstantin" ) {
						$q[$key]["task_status"] = 2;
					} else {
						$q[$key]["task_status"] = 0;
					}

					$q[$key]["task_count"] = 3;
					
					$q[$key]["group"] = "Filo Yönetim";
				}
				$DATA = $q;

			break;


			case 'add_daily_plan_schema':
				require CLASS_DIR . "GPEmployeeDailyPlanSchema.php";

                $Schema = new GPEmployeeDailyPlanSchema();
				$Schema->add( $_POST );
				$OK = (int)$Schema->getStatusFlag();
				$TEXT = $Schema->getReturnText();
				// last inserted id
                $DATA = $Schema->getDetails("id");

			break;

            case 'daily_plan_schemas_download':

                $DATA = DB::getInstance()->query("SELECT * FROM " . DBT_GPEMPLOYEEDAILYPLANSCHEMAS . " ORDER BY name LIMIT {$_POST["start_index"]},{$_POST["rrp"]}")->results();

            break;

            case 'daily_plan_schemas_search':
                $DATA = DB::getInstance()->query("SELECT * FROM " . DBT_GPEMPLOYEEDAILYPLANSCHEMAS .
                    " WHERE name LIKE ? || name LIKE ? || name LIKE ? ORDER BY name DESC LIMIT {$_POST["start_index"]},{$_POST["rrp"]}",
                    array( "%".$_POST["keyword"], $_POST["keyword"]."%", "%".$_POST["keyword"]."%"))->results();
            break;


		}

		die(json_encode(array(
			"ok" 	=> $OK,
			"text" 	=> $TEXT,
			"data" 	=> $DATA,
			"oh" 	=> $_POST
		)));

	}
