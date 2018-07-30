<?php
    /* Gitaş - Obarey Inc. 2018 */
    /* main web service */
	require 'inc/defs.php';

	if( $_POST ) {

        $OK = 1;
        $TEXT = "";
        $DATA = array();

        // login
        $User = new GPApiUser(array(
            "api_email"         => $_POST["api_email"],
            "api_password"      => $_POST["api_password"],
            "api_device_hash"   => $_POST["api_device_hash"],
            "api_device_name"   => $_POST["api_device_name"],
            "api_device_type"   => $_POST["api_device_type"],
            "api_device_os"     => $_POST["api_device_os"]
        ));
        if (!$User->getStatusFlag()) {
            die(json_encode(array(
                "ok" => 0,
                "text" => $User->getReturnText(),
                "oh" => $_POST
            )));
        }


        // todo - permission check yap each action için

        switch ($_POST["req"]) {

            case 'app_server_sync':

                $q = GPDBFetch::action(DBT_GPAPITRIGGERSNOTCHECKED, array("trigger_id"), array(), array("keys" => "device_id = ?", "vals" => array(Client::getDevice()->getDetails("id"))));
                foreach( $q as $triggerData ){
                    $ApiTrigger = new GPApiTrigger($triggerData["trigger_id"]);
                    if( !$ApiTrigger->getStatusFlag() ) continue;
                    $DATA[] = $ApiTrigger->getDetails();
                }

            break;

            case 'download_cached_data':

                /*$DATA["user_groups"] = "obarey";
                $DATA["permissions_template"] = "obarey";
                $DATA["plan_schemas"] = "iteroy";*/

            break;

            case 'app_server_sync_init':

                // download static data for first sync or if some
                // cached files in client's computer are deleted



            break;



            case 'add_daily_plan_schema':
                require CLASS_DIR . "GPEmployeeDailyPlanSchema.php";

                $Schema = new GPEmployeeDailyPlanSchema();
                $OK = (int)$Schema->add($_POST);
                $TEXT = $Schema->getReturnText();
                // last inserted id
                $DATA = $Schema->getDetails("id");

            break;

            case 'daily_plan_schemas_download':
                $DATA = GPDBFetch::action(DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ));
            break;

            case 'daily_plan_schemas_search':
                $DATA = GPDBFetch::search(DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ), array("key" => "name", "keyword" => $_POST["keyword"]));
            break;

            case 'employee_groups_download':
                $DATA = GPDBFetch::action(DBT_GPEMPLOYEEGROUPS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ));
            break;

            case 'employee_groups_search':
                $DATA = GPDBFetch::search(DBT_GPEMPLOYEEGROUPS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ), array("key" => "name", "keyword" => $_POST["keyword"]));
            break;

            case 'add_employee_group':

                require CLASS_DIR . "GPEmployeeGroup.php";
                $EmployeeGroup = new GPEmployeeGroup();
                $OK = (int) $EmployeeGroup->add( $_POST );
                $DATA = $EmployeeGroup->getDetails("id");
                $TEXT = $EmployeeGroup->getReturnText();

            break;


            // test
            case 'employees_download':

                // todo - kullanıcının astı olan employee ler çekilecek
                $q = GPDBFetch::action(DBT_GPEMPLOYEES, array("id", "name", "email", "employee_group", "nick"),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ));
                foreach ($q as $key => $val) {
                    if ($val["name"] == "Serpil Boyacıoğlu") {
                        $q[$key]["task_status"] = 1;
                    } else if ($val["name"] == "Veli Konstantin") {
                        $q[$key]["task_status"] = 2;
                    } else {
                        $q[$key]["task_status"] = 0;
                    }
                    $q[$key]["task_count"] = 3;
                }
                $DATA = $q;

            break;

            case 'employees_search':

                // todo - kullanıcının astı olan employee ler çekilecek

                $q = GPDBFetch::search(DBT_GPEMPLOYEES, array("id", "name", "email", "employee_group", "nick"),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ),
                    array("key" => "name", "keyword" => $_POST["keyword"]));

                foreach ($q as $key => $val) {
                    $q[$key]["task_status"] = 2;
                    $q[$key]["task_count"] = 3;
                    $q[$key]["group"] = "Filo Yönetim";
                }
                $DATA = $q;
            break;

            case 'add_employee':

                require CLASS_DIR . "GPEmployeeGroup.php";
                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee();
                $OK = (int) $Employee->add($_POST);
                $DATA = $Employee->getDetails("id");
                $TEXT = $Employee->getReturnText();

            break;

            case 'tasks_download':
                $q = GPDBFetch::action(DBT_GPTASKS, array("id", "name", "group_id", "type", "definition"),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ), array( "keys" => "deleted = ?", "vals" => array(0)  ));
                foreach ($q as $key => $val) {
                    $q[$key]["group"] = "Obarey grup.";
                }
                $DATA = $q;
            break;

            case 'tasks_search':
                $q = GPDBFetch::search(DBT_GPTASKS,  array("id", "name", "group_id", "type", "definition"),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ),
                    array("key" => "name", "keyword" => $_POST["keyword"]),
                    array( "keys" => "deleted = ?", "vals" => array(0)  ));
                foreach ($q as $key => $val) {
                    $q[$key]["task_status"] = 2;
                    $q[$key]["task_count"] = 3;
                    $q[$key]["group"] = "Filo Yönetim";
                }
                $DATA = $q;
            break;

        }

        die(json_encode(array(
            "ok" => $OK,
            "text" => $TEXT,
            "data" => $DATA,
            "oh" => $_POST
        )));

    }
