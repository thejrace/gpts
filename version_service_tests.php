<?php

    require 'inc/test_defs.php';
    define( "URL", VERSION_SERVICE_URL );


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

   function version_control_check(){
       print_r( post( URL, array("req" => "update_check", "version_info" => "1.0.0")));
   }

    version_control_check();