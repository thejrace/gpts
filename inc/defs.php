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

    require CLASS_DIR . "Common.php";
    require CLASS_DIR . "DB.php";