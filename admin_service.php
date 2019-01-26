<?php
    /* Gitaş - Obarey Inc. 2018 */
    /* main admin web service */
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


        switch ($_POST["req"]) {

            case 'employees_download':

                $DATA = GPDBFetch::action(
                    DBT_GPEMPLOYEES,
                    array( "id", "name", "employee_group" ),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ),
                    array("keys" => "employee_group != ? && deleted = ?", "vals" => array(GPApiUser::$ADMIN, 0) ) );

            break;

            case 'employees_search':

                if( isset($_POST["rrp"]) && isset($_POST["start_index"])){
                    $settings = array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"]
                    );
                } else {
                    $settings = array( "order_by" => array("name ASC") );
                }

                $DATA = GPDBFetch::search(
                    DBT_GPEMPLOYEES,
                    array( "id", "name", "employee_group" ),
                    $settings,
                    array("key" => "name", "keyword" => $_POST["keyword"]),
                    array("keys" => "employee_group != ?", "vals" => array(GPApiUser::$ADMIN) ) );

            break;

            case 'employee_groups_download':

                $DATA = GPDBFetch::action(
                    DBT_GPEMPLOYEEGROUPS,
                    array( "id" , "name",  "parent" ),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ));
            break;

            case 'employee_groups_search':

                $DATA = GPDBFetch::search(
                    DBT_GPEMPLOYEEGROUPS,
                    array( "id" , "name",  "parent" ),
                    array(
                        "limit" => $_POST["rrp"],
                        "start_index" => $_POST["start_index"],
                        "order_by" => array("name ASC")
                    ),
                    array("key" => "name", "keyword" => $_POST["keyword"] ) );
            break;



            case 'add_employee':

                require CLASS_DIR . "GPEmployeeGroup.php";
                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee();
                $OK = (int) $Employee->add($_POST);
                $DATA = $Employee->getDetails("id");
                $TEXT = $Employee->getReturnText();


            break;

            case 'delete_employee':

                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee( $_POST["item_id"]);
                $OK = (int) $Employee->editCol(array("deleted" => 1));
                $TEXT = $Employee->getReturnText();


            break;

            case 'download_related_employees':

                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee( $_POST["item_id"] );
                $OK = (int)$Employee->getStatusFlag();
                $DATA = $Employee->beautifyRelatedEmployees();
                $TEXT = $Employee->getReturnText();

            break;

            case 'add_employee_relation':

                require CLASS_DIR . "GPEmployeeRelation.php";
                require CLASS_DIR . "GPEmployee.php";

                $Parent = new GPEmployee($_POST["parent_employee"]);
                $OK = (int)$Parent->addRelation( $_POST["child_employee"]);
                $TEXT = $Parent->getReturnText();

            break;

            case 'delete_employee_relation':

                require CLASS_DIR . "GPEmployeeRelation.php";
                $Relation = new GPEmployeeRelation( $_POST["parent_employee"],  $_POST["child_employee"] );
                $OK = (int)$Relation->delete();
                $TEXT =  $Relation->getReturnText();

            break;


            case 'edit_employee':

                require CLASS_DIR . "GPEmployeeGroup.php";
                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee( $_POST["item_id"]);
                $OK = (int) $Employee->edit($_POST);
                $TEXT = $Employee->getReturnText();

            break;

            case 'download_employee_data':

                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee($_POST["item_id"]);
                $OK = (int)$Employee->getStatusFlag();
                $DATA = $Employee->getDetails();
                $TEXT = $Employee->getReturnText();

            break;

            case 'add_employee_group':

                require CLASS_DIR . "GPEmployeeGroup.php";
                $EmployeeGroup = new GPEmployeeGroup();
                $OK = (int) $EmployeeGroup->add( $_POST );
                $DATA = $EmployeeGroup->getDetails("id");
                $TEXT = $EmployeeGroup->getReturnText();


            break;

            case 'edit_employee_group':

                require CLASS_DIR . "GPEmployeeGroup.php";
                $EmployeeGroup = new GPEmployeeGroup( $_POST["item_id"]);
                $OK = (int) $EmployeeGroup->edit($_POST);
                $TEXT = $EmployeeGroup->getReturnText();

            break;

            case 'delete_employee_group':

                require CLASS_DIR . "GPEmployeeGroup.php";
                $EmployeeGroup = new GPEmployeeGroup($_POST["item_id"]);
                $OK = (int)$EmployeeGroup->delete();
                $TEXT = $EmployeeGroup->getReturnText();

            break;

            case 'download_employee_group_data':

                require CLASS_DIR . "GPEmployeeGroup.php";
                $EmployeeGroup = new GPEmployeeGroup($_POST["item_id"]);
                $DATA = $EmployeeGroup->getDetails();

            break;


            // @DEPRECATED
            case 'download_employees':
                $DATA["employees"] = GPDBFetch::action(DBT_GPEMPLOYEES, array( "id", "name", "employee_group" ), array(), array("keys" => "employee_group != ?", "vals" => array(GPApiUser::$ADMIN) ) );
                $DATA["employee_groups"] = GPDBFetch::action(DBT_GPEMPLOYEEGROUPS, array( "id" , "name",  "parent"  ), array());
            break;

            // @DEPRECATED
            case 'download_employee_groups_all':
                $DATA = GPDBFetch::action(DBT_GPEMPLOYEEGROUPS, array( "id" , "name",  "parent"  ), array());
            break;

        }

        die(json_encode(array(
            "ok" => $OK,
            "text" => $TEXT,
            "data" => $DATA,
            "oh" => $_POST
        )));


    }
