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
            "api_password"      => @$_POST["api_password"],
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

            case 'update_check':

                require CLASS_DIR . "GPApiDesktopAppUpdateCheck.php";
                $Ver = new GPApiDesktopAppUpdateCheck( $_POST["version_info"] );
                if( $Ver->getStatusFlag() ){
                    $OK = (int)$Ver->getDetails("last_stable");
                } else {
                    $OK = 0;
                }

            break;

            case 'device_check':

                $OK = 1;
                $TEXT = $User->getReturnText();

            break;

            case 'desktop_login':

                $OK = 1;
                $TEXT = $User->getReturnText();

            break;

            case 'app_server_sync':

                $q = GPDBFetch::action(DBT_GPAPITRIGGERSNOTCHECKED, array("trigger_id"), array(), array("keys" => "device_id = ?", "vals" => array(Client::getDevice()->getDetails("id"))));
                foreach( $q as $triggerData ){
                    $ApiTrigger = new GPApiTrigger($triggerData["trigger_id"]);
                    if( !$ApiTrigger->getStatusFlag() ) continue;
                    $DATA[] = $ApiTrigger->getDetails();
                }

            break;

            case 'download_cached_data':

                $DATA["employee_groups"] = file_get_contents(DATA_CACHE_DIR . "employee_groups.json" );
                $DATA["permissions_template"] = file_get_contents(DATA_CACHE_DIR . "permissions_template.json" );
                $DATA["plan_schemas"] = file_get_contents(DATA_CACHE_DIR . "plan_schemas.json" );

            break;

            case 'app_server_sync_init':

                // download static data for first sync or if some
                // cached files in client's computer are deleted

            break;

            case 'add_daily_plan_schema':

                // todo permission check
                require CLASS_DIR . "GPEmployeeDailyPlanSchema.php";

                $Schema = new GPEmployeeDailyPlanSchema();
                $OK = (int)$Schema->add($_POST);
                $TEXT = $Schema->getReturnText();
                // last inserted id
                $DATA = $Schema->getDetails("id");

            break;

            case 'daily_plan_schemas_download':

                // todo permission check

                $DATA = GPDBFetch::action(DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ));
            break;

            case 'daily_plan_schemas_search':

                // todo permission check

                $DATA = GPDBFetch::search(DBT_GPEMPLOYEEDAILYPLANSCHEMAS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ), array("key" => "name", "keyword" => $_POST["keyword"]));
            break;

            case 'employee_groups_download':

                // todo permission check

                $DATA = GPDBFetch::action(DBT_GPEMPLOYEEGROUPS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ));
            break;

            case 'employee_groups_search':

                // todo permission check

                $DATA = GPDBFetch::search(DBT_GPEMPLOYEEGROUPS, array(),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ), array("key" => "name", "keyword" => $_POST["keyword"]));
            break;

            case 'add_employee_group':

                // todo permission check

                require CLASS_DIR . "GPEmployeeGroup.php";
                $EmployeeGroup = new GPEmployeeGroup();
                $OK = (int) $EmployeeGroup->add( $_POST );
                $DATA = $EmployeeGroup->getDetails("id");
                $TEXT = $EmployeeGroup->getReturnText();

            break;

            case 'employees_download':

                // todo permission check

                require CLASS_DIR . "GPEmployee.php";
                require CLASS_DIR . "GPEmployeeGroup.php";
                $Employee = new GPEmployee($User->getDetails("email"));
                $DATA = $Employee->getRelatedEmployeesForDesktopApp(
                    array("id", "name", "email", "employee_group", "nick", "work_status"),
                    array( "rrp" => $_POST["rrp"], "start_index" => $_POST["start_index"]));

            break;

            case 'employees_search':

                // todo permission check

                require CLASS_DIR . "GPEmployee.php";
                require CLASS_DIR . "GPEmployeeGroup.php";
                $Employee = new GPEmployee($User->getDetails("email"));
                if( isset($_POST["rrp"]) && isset($_POST["start_index"] ) ){
                    $DATA = $Employee->searchRelatedEmployeesForDesktopApp($_POST["keyword"], array("id", "name", "email", "employee_group", "nick", "work_status"), $_POST["rrp"], $_POST["start_index"]);
                } else {
                    $DATA = $Employee->searchRelatedEmployeesForDesktopApp($_POST["keyword"], array("id", "name") );
                }


                break;

            case 'add_employee':

                // todo permission check

                require CLASS_DIR . "GPEmployeeGroup.php";
                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee();
                $OK = (int) $Employee->add($_POST);
                $DATA = $Employee->getDetails("id");
                $TEXT = $Employee->getReturnText();

            break;

            // TODO - SYSTEM ADMIN ONLY
            case 'add_employee_relation':

                require CLASS_DIR . "GPEmployeeRelation.php";
                require CLASS_DIR . "GPEmployee.php";

                $Parent = new GPEmployee($_POST["parent_employee"]);
                $Parent->addRelation( $_POST["child_employee"]);
                $TEXT = $Parent->getReturnText();

            break;

            // deprecated ( 15.09.2018 )
            case 'tasks_download':

                // todo permission check

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

            // deprecated ( 15.09.2018 )
            case 'tasks_search':

                // todo permission check

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

            case 'add_work':

                require CLASS_DIR . "GPEmployeeWorkTemplate.php";
                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWork.php";

                $GPWork = new GPEmployeeWork();
                $OK = (int)$GPWork->add($_POST);
                $TEXT = $GPWork->getReturnText();
                $DATA = array(
                    "id" => $GPWork->getDetails("id"),
                    "date_added" => $GPWork->getDetails("date_added"),
                    "added_sub_items_data" => $GPWork->getDetails("added_sub_items_data")
                );

            break;

            case 'edit_work':

                require CLASS_DIR . "GPEmployeeWorkTemplate.php";
                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWork.php";

                $GPWork = new GPEmployeeWork( $_POST["item_id"]);
                $OK = (int)$GPWork->edit($_POST);
                $TEXT = $GPWork->getReturnText();

            break;

            // deprecated ( 15.09.2018 )
            case 'complete_work':

                require CLASS_DIR . "GPEmployeeWorkTemplate.php";
                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWork.php";

                $GPWork = new GPEmployeeWork( $_POST["item_id"] );
                if( $GPWork->getStatusFlag() ){
                    if( !$GPWork->changeStatus(GPEmployeeWork::$STATUS_COMPLETED)) $OK = 0;
                } else {
                    $OK = 0;
                }
                $TEXT = $GPWork->getReturnText();

            break;

            case 'works_download':

                // todo permission check

                $q = GPDBFetch::action(DBT_GPEMPLOYEEWORKTEMPLATES, array("id", "name", "details", "sub_items"),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ));
                foreach ($q as $key => $val) {
                    $q[$key]["sub_items"] = json_decode($q[$key]["sub_items"], true);
                }
                $DATA = $q;

                break;

            case 'search_work_template':

                require CLASS_DIR . "GPEmployeeWorkTemplate.php";
                if( isset($_POST["rrp"]) && isset($_POST["start_index"] ) ){
                    $DATA = GPEmployeeWorkTemplate::searchForDesktopApp(
                        $_POST["keyword"],
                        array( "id", "name", "details", "sub_items"),
                        $_POST["rrp"],
                        $_POST["start_index"],
                        array("name ASC")
                    );
                } else {
                    $DATA = GPEmployeeWorkTemplate::search( $_POST["search_keyword"] );
                }

            break;

            case 'download_work_templates':

                require CLASS_DIR . "GPEmployeeWorkTemplate.php";
                $DATA = GPEmployeeWorkTemplate::getForDesktopApp(
                    array( "id", "name", "details", "sub_items"),
                    $_POST["rrp"],
                    $_POST["start_index"],
                    array("name ASC")
                );

            break;

            case 'add_work_template':

                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWorkTemplate.php";

                $Template = new GPEmployeeWorkTemplate();
                // explode sub items and decode action
                if( $_POST["sub_items_encoded"] != "" ){
                    $subItems = array();
                    foreach( explode("|", $_POST["sub_items_encoded"] ) as $param ) $subItems[] = GPEmployeeWorkSubItem::decodeParams( $param );
                    $subItemsEncoded = json_encode( $subItems );
                } else {
                    // if no subItem is submitted, use empty jsonarray
                    $subItemsEncoded = "[]";
                }
                $params = array(
                    "name"      => $_POST["name"],
                    "details"   => $_POST["details"],
                    "sub_items" => $subItemsEncoded
                );
                $OK = (int) $Template->add($params);
                $TEXT = $Template->getReturnText();
                $DATA = $Template->getDetails("id");

            break;

            case 'edit_work_template':

                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWorkTemplate.php";

                $Template = new GPEmployeeWorkTemplate( $_POST["item_id"]);
                if( $Template->getStatusFlag() ){
                    // explode sub items and decode actions
                    if( $_POST["sub_items_encoded"] != "" ){
                        $subItems = array();
                        foreach( explode("|", $_POST["sub_items_encoded"] ) as $param ) $subItems[] = GPEmployeeWorkSubItem::decodeParams( $param );
                        $subItemsEncoded = json_encode( $subItems );
                    } else {
                        // if no subItem is submitted, use empty jsonarray
                        $subItemsEncoded = "[]";
                    }
                    $params = array(
                        "name"      => $_POST["name"],
                        "details"   => $_POST["details"],
                        "sub_items" => $subItemsEncoded
                    );
                    $OK = (int) $Template->edit($params);
                } else {
                    $OK = 0;
                }
                $TEXT = $Template->getReturnText();


            break;

            // deprecated ( 15.09.2018 )
            case 'download_employee_active_works':
                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWork.php";
                require CLASS_DIR . "GPEmployee.php";

                $Employee = new GPEmployee( $User->getDetails("email") );
                $DATA = $Employee->getActiveWorks();
            break;

            case 'employee_works_download':

                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWork.php";
                require CLASS_DIR . "GPEmployee.php";

                // we can download works of active user or other employees
                if( isset($_POST["employee_id"] ) ){
                    $Employee = new GPEmployee( $_POST["employee_id"] );
                    if( !$Employee->getStatusFlag() ){
                        $OK = 0;
                    }
                } else {
                    $Employee = new GPEmployee( $User->getDetails("email") );
                }
                if( $OK == 1 ){
                    $DATA = $Employee->getWorksForDesktopApp(
                        array("id", "name", "details", "date_added", "status", "due_date", "date_last_modified"),
                        $_POST["rrp"], $_POST["start_index"], array("id DESC"), $_POST["status_filter"]
                    );
                }

            break;

            case 'employee_works_search':

                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWork.php";
                require CLASS_DIR . "GPEmployee.php";

                $Employee = new GPEmployee( $User->getDetails("email") );
                $DATA = $Employee->searchWorksForDekstopApp(
                    $_POST["keyword"],
                    array("id", "name", "details", "date_added", "status", "due_date", "date_last_modified"),
                    $_POST["rrp"], $_POST["start_index"], array("id DESC"), $_POST["status_filter"]
                );

            break;

            case 'define_work_to':

                require CLASS_DIR . "GPEmployeeWorkPeriodicDefinition.php";
                require CLASS_DIR . "GPEmployeeWorkTemplate.php";
                require CLASS_DIR . "GPEmployeeWorkSubItem.php";
                require CLASS_DIR . "GPEmployeeWork.php";
                require CLASS_DIR . "GPEmployee.php";
                require CLASS_DIR . "GPEmployeeGroup.php";

                if( isset($_POST["employee_group_name"] ) ){
                    // define to employee group related to employee who defined the task
                    $ActiveEmployee = new GPEmployee($User->getDetails("email"));
                    foreach(  $ActiveEmployee->getRelatedEmployeesForDesktopApp( array("id"), array(), $_POST["employee_group_name"] ) as $empData ){
                        $ChildEmployee = new GPEmployee( $empData["id"] );
                        $OK = (int)$ChildEmployee->defineWork(array(
                                "work_template_id"  => $_POST["work_template_id"],
                                "name"              => $_POST["name"],
                                "details"           => $_POST["details"],
                                "sub_items_encoded" => $_POST["sub_items_encoded"],
                                "periodic_flag"     => $_POST["periodic_flag"],
                                "start_date"        => $_POST["start_date"],
                                "due_date"          => $_POST["due_date"],
                                "define_interval"   => $_POST["define_interval"] ));
                        $TEXT = $ChildEmployee->getReturnText();
                    }
                } else {
                    // define to employee
                    $Employee = new GPEmployee( $_POST["employee_id"] );
                    if( $Employee->getStatusFlag() ){
                        $OK = (int)$Employee->defineWork( array(
                                        "work_template_id"  => $_POST["work_template_id"],
                                        "name"              => $_POST["name"],
                                        "details"           => $_POST["details"],
                                        "sub_items_encoded" => $_POST["sub_items_encoded"],
                                        "periodic_flag"     => $_POST["periodic_flag"],
                                        "start_date"        => $_POST["start_date"],
                                        "due_date"          => $_POST["due_date"],
                                        "define_interval"   => $_POST["define_interval"] ));
                    } else {
                        $OK = 0;
                    }
                    $TEXT = $Employee->getReturnText();
                }

            break;



        }

        die(json_encode(array(
            "ok" => $OK,
            "text" => $TEXT,
            "data" => $DATA,
            "oh" => $_POST
        )));

    }
