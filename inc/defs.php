<?php
    /* Gitaş - Obarey Inc. 2018 */
	require 'datatables.php';

	define("DB_NAME", "gitas_es");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_IP", "localhost:3306");

	define("APP_VERSION", "v1.0.0.0");

	define("MAIN_DIR", $_SERVER["DOCUMENT_ROOT"] . "/gpts/");
    define("INC_DIR", MAIN_DIR . "inc/");
    define("CLASS_DIR", INC_DIR . "class/");

    if( !isset($_SESSION) ) session_start();

    require CLASS_DIR . "Common.php";
    require CLASS_DIR . "DB.php";
    require CLASS_DIR . "GPDBFetch.php";
    require CLASS_DIR . "GPFormValidation.php";
    require CLASS_DIR . "GPDataCommon.php";
    require CLASS_DIR . "GPApiAdminSessionToken.php";
    require CLASS_DIR . "GPApiUser.php";
    require CLASS_DIR . "GPApiUserDevice.php";
    require CLASS_DIR . "GPApiTrigger.php";

    // static client class to access active apiUser's information
    class Client {
        private static $DEVICE, $USER;
        public static function init( GPApiUser $user, GPApiUserDevice $device ){
            self::$USER = $user;
            self::$DEVICE = $device;
        }
        public static function getDevice(){
            return self::$DEVICE;
        }
        public static function getUser(){
            return self::$USER;
        }
    }