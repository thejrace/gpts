<?php
    /* Gitaş - Obarey Inc. 2018 */

    require '../inc/defs.php';

    require CLASS_DIR . "GPFormValidation.php";
    require CLASS_DIR . "GPDataCommon.php";
    require CLASS_DIR . "GPApiAdminSessionToken.php";
    require CLASS_DIR . "GPApiUserDevice.php";
    require CLASS_DIR . "GPApiUser.php";



    function main(){
        $User = new GPApiUser(array(
            "email" => "ahmet@obarey.com",
            "password" => "wazzabii308",
            "device_hash" => "test hash",
            "device_name" => "test device name",
            "device_type" => GPApiUserDevice::$PC,
            "device_os"   => "Windows"
        ));

        if( !$User->getStatusFlag() ){
            die( $User->getReturnText());
        }

        // edit col test
        $User->editCol(array(
            "user_group" => 1
        ));

        if( !$User->getStatusFlag() ){
            die( $User->getReturnText());
        }

        var_dump( $User->getStatusFlag());
        echo "<br>" . $User->getReturnText();
        echo "<br>";
        print_r($User->getDetails());

    }

    echo '<pre>';
    main();