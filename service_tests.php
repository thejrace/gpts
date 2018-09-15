<?php

    define("URL", "http://localhost/gpts/service.php");
    //define("URL", "http://178.18.206.163/gpts_web_service/service.php");

    function serializeParams( $data ){
        $joinArray = array();
        foreach( $data as $key => $val ) $joinArray[] = $key."=".$val;
        return implode("&", $joinArray );
    }

    function post( $url, $postData ){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, serializeParams($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $execResult = curl_exec($ch);
        return $execResult;
        //return json_decode( $execResult, true );
    }

    define("LOGINPARAMS", array(
        "api_email"         => "ahmet@obarey.com",
        "api_password"      => "wazzabii308",
        "api_device_hash"   => "test hash 3",
        "api_device_name"   => "test device name 2",
        "api_device_type"   => 1,
        "api_device_os"     => "Windows"
    ));

    function loginTest(){  // 27.06.2018 OK
        print_r( post( URL,
            array_merge(LOGINPARAMS, array("req" => "obarey"))
        ));
    }

    function employees_download(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "employees_download",
                    "rrp"               => "10",
                    "start_index"             => "0"
                )
            )
        ));
    }

    function add_daily_plan_schema_test(){  // 27.06.2018 OK
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "add_daily_plan_schema",
                    "name"              => "Test Obarey 9",
                    "start"             => "08:00",
                    "end"               => "13:00",
                    "plan_interval"     => "55"
                )
            )
        ));
    }

    function app_server_sync_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "app_server_sync"
                )
            )
        ));
    }

    function add_employee_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "add_employee",
                    "nick" 		        => "@coldplay",
                    "email" 	        => "cold@test.com",
                    "name" 		        => "Coldplay",
                    "employee_group" 	=> "Filo Yönetim",
                    "phone_1"           => "0533",
                    "phone_2"           => ""
                )
            )
        ));
    }

    function add_employee_group_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "add_employee_group",
                    "name" 		        => "Mühendis"
                )
            )
        ));
    }

    function add_relation_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "add_employee_relation",
                    "parent_employee" 	=> "1",
                    "child_employee"    => "2"
                )
            )
        ));
    }

    function add_work(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "add_work",
                    "name" 	            => "Test Work OBarey",
                    "details"           => "test details",
                    "status"            => "0",
                    "sub_items_encoded" => "id=0#name=Testobo1#details=testers#step_order=1#status=0|id=0#name=Keke 2#details=#step_order=2#status=0|id=0#name=Bbebe 1234#details=#step_order=3#status=0"
                )
            )
        ));
    }

    function work_change_status(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "complete_work",
                    "item_id" 	        => "2"
                )
            )
        ));
    }

    function search_work_template(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "search_work_template",
                    "search_keyword" 	=> "obarey"
                )
            )
        ));
    }

    function download_employee_active_works(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "download_employee_active_works"
                )
            )
        ));
    }

    function edit_work(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                    => "edit_work",
                    "sub_items_encoded"      => "id=21#name=test 123#details=at#step_order=1#status=0|id=22#name=test 444#details=4131341#step_order=2#status=0",
                    "item_id"                => "8",
                    "name"                   => "Yeni i\u015f",
                    "details"                => "beybe",
                    "status"                 => "1"
                )
            )
        ));
    }
    echo '<pre>';
    //loginTest();
    //employees_download();
    //add_daily_plan_schema_test();
    //app_server_sync_test();
    //add_employee_test();
    //add_employee_group_test();
    //add_relation_test();
    //get_relations_test();
    //add_work();
    //work_change_status();
    //search_work_template();
    //download_employee_active_works();
    edit_work();