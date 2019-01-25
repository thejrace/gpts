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

            case 'download_employees':

                $DATA["employees"] = GPDBFetch::action(DBT_GPEMPLOYEES, array( "id", "name", "employee_group" ), array(), array("keys" => "employee_group != ?", "vals" => array(GPApiUser::$ADMIN) ) );
                $DATA["employee_groups"] = GPDBFetch::action(DBT_GPEMPLOYEEGROUPS, array( "id" , "name",  "parent"  ), array());

            break;

            case 'download_employee_groups':
                $DATA["employee_groups"] = GPDBFetch::action(DBT_GPEMPLOYEEGROUPS, array( "id" , "name",  "parent"  ), array());
            break;


            case 'add_employee':

                require CLASS_DIR . "GPEmployeeGroup.php";
                require CLASS_DIR . "GPEmployee.php";
                $Employee = new GPEmployee();
                $OK = (int) $Employee->add($_POST);
                $DATA = $Employee->getDetails("id");
                $TEXT = $Employee->getReturnText();


            break;

            case 'add_employee_group':

                require CLASS_DIR . "GPEmployeeGroup.php";
                $EmployeeGroup = new GPEmployeeGroup();
                $OK = (int) $EmployeeGroup->add( $_POST );
                $DATA = $EmployeeGroup->getDetails("id");
                $TEXT = $EmployeeGroup->getReturnText();


            break;

        }

        die(json_encode(array(
            "ok" => $OK,
            "text" => $TEXT,
            "data" => $DATA,
            "oh" => $_POST
        )));


    }
