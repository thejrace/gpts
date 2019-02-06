<?php

    require 'inc/test_defs.php';
    define( "URL", ADMIN_SERVICE_URL );

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

    // ayarli
    function employees_download(){
        print_r( post( URL,
            array_merge(LOGINPARAMS, array("req" => "employees_download", "rrp" => 1, "start_index" => 0 ))
        ));
    }

    function employees_search(){
        print_r( post( URL,
            array_merge(LOGINPARAMS, array("req" => "employees_search", "rrp" => 1, "start_index" => 0, "keyword" => "emr" ))
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

    function add_relation_test(){
        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "add_employee_relation",
                    "rel_type" 		     => "e",
                    "parent"            => "2",
                    "child"             => "4"
                )
            )
        ));
    }

    // KULLANIRKEN DİKKATLİ OL
    function release_new_desktop_app_version_test(){

        print_r( post(URL,
            array_merge(LOGINPARAMS,
                array(
                    "req"               => "release_new_desktop_app_version",
                    "version_info" 		 => "1.0.12",
                    "details"           => "Setup - config intergration bug fix."
                )
            )
        ));
    }

    echo '<pre>';

    //loginTest();
    //download_employees()
    //employees_download();
    //employees_search();
    //add_employee_group_test();
    //add_relation_test();
    release_new_desktop_app_version_test();