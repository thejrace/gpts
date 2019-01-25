<?php

    define("URL", "http://localhost/gpts/admin_service.php");
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
        "api_email"         => "admin@obarey.com",
        "api_password"      => "gitas_admin@obarey.com",
        "api_device_hash"   => "admin_service_test",
        "api_device_name"   => "admin_service_test",
        "api_device_type"   => 1,
        "api_device_os"     => "Windows"
    ));

    function loginTest(){  // 24.01.2019 OK
        print_r( post( URL,
            array_merge(LOGINPARAMS, array("req" => "obarey"))
        ));
    }

    function download_employees(){
        print_r( post( URL,
            array_merge(LOGINPARAMS, array("req" => "download_employees"))
        ));
    }

    function add_employee_group_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "add_employee_group",
                    "name" 		        => "Test 3",
                    "permissions"       => "1111111111111111111111"
                )
            )
        ));
    }


    //loginTest();
    //download_employees()
    //add_employee_group_test();