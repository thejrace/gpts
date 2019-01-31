<?php
    define("LOCAL", true );
    if( LOCAL ){
        define("SERVICE_URL", "http://localhost/gpts/service.php");
        define("ADMIN_SERVICE_URL", "http://localhost/gpts/admin_service.php");
        define("VERSION_SERVICE_URL", "http://localhost/gpts/version_service.php");
    } else {
        define("SERVICE_URL", "http://localhost/gpts_web_service/service.php");
        define("ADMIN_SERVICE_URL", "http://localhost/gpts_web_service/admin_service.php");
        define("VERSION_SERVICE_URL", "http://localhost/gpts_web_service/version_service.php");
    }