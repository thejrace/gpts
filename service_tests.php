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
        "email"         => "ahmet@obarey.com",
        "password"      => "wazzabii308",
        "device_hash"   => "test hash",
        "device_name"   => "test device name",
        "device_type"   => 1,
        "device_os"     => "Windows"
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
                    "name"              => "Test Obarey 5",
                    "start"             => "08:00",
                    "end"               => "13:00",
                    "plan_interval"     => "55"
                )
            )
        ));
    }



    echo '<pre>';
    //loginTest();
    //add_daily_plan_schema_test();