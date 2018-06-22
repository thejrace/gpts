<?php
    /* Gitaş - Obarey Inc. 2018 */
    /* main web service */
	require 'inc/defs.php';

	require CLASS_DIR . "GPDBFetch.php";
	require CLASS_DIR . "GPFormValidation.php";
	require CLASS_DIR . "GPDataCommon.php";
	require CLASS_DIR . "GPEmployee.php";

	if( $_POST ){

		$OK = 1;
		$TEXT = "";
		$DATA = array();

		switch( $_POST["req"] ){


            case 'app_server_sync':



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
                $DATA = GPDBFetch::action( DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array(),
                    array(
                        "limit"          => $_POST["rrp"],
                        "start_index"    => $_POST["start_index"],
                         "order_by"       => array( "name ASC" )
                    ));
            break;

            case 'daily_plan_schemas_search':
                $DATA = GPDBFetch::search( DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array(),
                    array(
                        "limit"          => $_POST["rrp"],
                        "start_index"    => $_POST["start_index"],
                        "order_by"       => array( "name ASC" )
                    ), array("key" => "name", "keyword" => $_POST["keyword"] ));
            break;

            // test
            case 'employees_download':
                $q = GPDBFetch::action( DBT_GPEMPLOYEES, array( "id", "name", "email", "group_id", "nick" ),
                    array(
                        "limit"          => $_POST["rrp"],
                        "start_index"    => $_POST["start_index"],
                        "order_by"       => array( "name ASC" )
                    ));
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

            case 'employees_search':
                $q = GPDBFetch::search( DBT_GPEMPLOYEES, array( "id", "name", "email", "group_id", "nick" ),
                    array(
                        "limit"          => $_POST["rrp"],
                        "start_index"    => $_POST["start_index"],
                        "order_by"       => array( "name ASC" )
                    ),
                    array( "key" => "name", "keyword" => $_POST["keyword"] ));

                foreach( $q as $key => $val ){
                    $q[$key]["task_status"] = 2;
                    $q[$key]["task_count"] = 3;
                    $q[$key]["group"] = "Filo Yönetim";
                }
                $DATA = $q;
            break;


		}

		die(json_encode(array(
			"ok" 	=> $OK,
			"text" 	=> $TEXT,
			"data" 	=> $DATA,
			"oh" 	=> $_POST
		)));

	}