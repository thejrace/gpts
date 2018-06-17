<?php
    /* Gitaş - Obarey Inc. 2018 */

    require '../inc/defs.php';

    require CLASS_DIR . "GPFormValidation.php";
    require CLASS_DIR . "GPDataCommon.php";
    require CLASS_DIR . "GPApiAdminSessionToken.php";
    require CLASS_DIR . "GPApiUserDevice.php";
    require CLASS_DIR . "GPApiUser.php";


    function login(){

        $User = new GPApiUser(array(
            "email" => "ahmet@obarey.com",
            "password" => "wazzabii308",
            "device_hash" => "test hash",
            "device_name" => "test device name",
            "device_type" => GPApiUserDevice::$PC,
            "device_os"   => "Windows"
        ));
        var_dump( $User->getStatusFlag());
        echo "<br>" . $User->getReturnText();

    }


    function main(){
        login();
    }

    echo '<pre>';
    main();