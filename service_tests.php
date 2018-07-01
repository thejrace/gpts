<?php

    define("URL", "http://localhost/gpts/service.php");

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
        //return $execResult;
        return json_decode( $execResult, true );
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
                    "nick" 		        => "@eyupp",
                    "email" 	        => "eyup2@test.com",
                    "name" 		        => "Eyüp Bey 2",
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



    echo '<pre>';
    //loginTest();
    //add_daily_plan_schema_test();
    //app_server_sync_test();
    //add_employee_test();
    //add_employee_group_test();