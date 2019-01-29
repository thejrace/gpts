<?php

    require 'inc/test_defs.php';
    define( "URL", SERVICE_URL );


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
        "api_email"         => "ahmet@ahmet.com",
        "api_device_hash"   => "ce457a246dc6cb6e78957c0287697b944209af594bcb85bcc4677eda6b2d93f8",
        "api_device_name"   => "DESKTOP-9PQ3U3N",
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
                    "nick" 		        => "@admin",
                    "email" 	        => "admin@obarey.com",
                    "name" 		        => "Obarey Admin",
                    "employee_group" 	=> "Admin",
                    "phone_1"           => "",
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
                    "name" 		        => "Admin",
                    "permissions"       => "1111111111111111111111"
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
                    "name" 	            => "Overdrive 3",
                    "details"           => "test details",
                    "status"            => "0",
                    "sub_items_encoded" => "id=0#name=Testobo1#details=testers#step_order=1#status=0|id=0#name=Keke 2#details=#step_order=2#status=0|id=0#name=Bbebe 1234#details=#step_order=3#status=0"
                )
            )
        ));
    }
    function edit_work(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                    => "edit_work",
                    "sub_items_encoded"      => "id=69#name=Adım 1#details=#step_order=1#status=0|id=68#name=Adım 2#details=test 2#step_order=2#status=0",
                    "item_id"                => "22",
                    "name"                   => "Yağ Obarey",
                    "details"                => "beybe",
                    "status"                 => "1"
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
    function search_work_template_with_settings(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "search_work_template",
                    "keyword" 	        => "Haydar",
                    "rrp"               => "10",
                    "start_index"       => "0"
                )
            )
        ));
    }
    function download_work_templates(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "download_work_templates",
                    "rrp"               => "10",
                    "start_index"       => "0"
                )
            )
        ));
    }
    function add_work_template(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                     => "add_work_template",
                    "name"                    => "Test work template",
                    "details"                 => "test work template details beybe",
                    "sub_items_encoded"       => "id=0#name=Obarey adım 1#details=null#step_order=1#status=0|id=0#name=Obarey adım 2#details=null#step_order=2#status=0"
                )
            )
        ));
    }
    function edit_work_template(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                     => "edit_work_template",
                    "item_id"                 => "21",
                    "name"                    => "Test work template şşşşttt",
                    "details"                 => "test work template details beybe kekekeke",
                    "sub_items_encoded"       => "id=0#name=Obarey adım 13#details=null#step_order=1#status=0|id=0#name=Obarey adım 333332#details=null#step_order=2#status=0"
                )
            )
        ));
    }

    function download_employee_active_works(){ // deprecated ( 15.09.2018 )
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "download_employee_active_works"
                )
            )
        ));
    }
    function employee_works_download(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "employee_works_download",
                    "rrp"               => "10",
                    "start_index"       => "0",
                    "status_filter"     => "1"
                )
            )
        ));
    }
    function employee_works_search(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "employee_works_search",
                    "rrp"               => "10",
                    "start_index"       => "0",
                    "status_filter"     => "0",
                    "keyword"           => "kayne"
                )
            )
        ));
    }

    function define_work_to_employee(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                        => "define_work_to",
                    "work_template_id"           => "1",
                    "employee_group_name"        => "2",
                    "periodic_flag"              => "1",
                    "start_date"                 => "null",
                    "due_date"                   => "60",
                    "define_interval"            => "350",
                    "name"                       => "Cenkordem",
                    "details"                    => "Vampiria define details",
                    "sub_items_encoded"          => "id=0#name=Obarey adım 13#details=null#step_order=1#status=0|id=0#name=Obarey adım 333332#details=null#step_order=2#status=0"
                )
            )
        ));
    }

    function define_work_to_employee_group(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                        => "define_work_to",
                    "work_template_id"           => "1",
                    "employee_group_name"        => "2",
                    "periodic_flag"              => "0",
                    "start_date"                 => "null",
                    "due_date"                   => "2018-10-11 14:33:00",
                    "define_interval"            => "350",
                    "name"                       => "Cenkordem",
                    "details"                    => "Vampiria define details",
                    "sub_items_encoded"          => "id=0#name=Obarey adım 13#details=null#step_order=1#status=0|id=0#name=Obarey adım 333332#details=null#step_order=2#status=0"
                )
            )
        ));
    }

    function device_check_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                        => "device_check"
                )
            )
        ));
    }

    function download_cached_data_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"                        => "download_cached_data"
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
    //search_work_template_with_settings();
    //download_work_templates();
    //add_work_template();
    //edit_work_template();
    //download_employee_active_works();
    //employee_works_download();
    //employee_works_search();
    //edit_work();
    // define_work_to_employee();
    //define_work_to_employee_group();
    //device_check_test();
    download_cached_data_test();