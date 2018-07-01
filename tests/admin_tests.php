<?php
    /* Gitaş - Obarey Inc. 2018 */

    require '../inc/defs.php';

    require CLASS_DIR . "GPFormValidation.php";
    require CLASS_DIR . "GPDataCommon.php";
    require CLASS_DIR . "GPApiAdminSessionToken.php";
    require CLASS_DIR . "GPApiUser.php";

    if( $_POST ){
        if( $_POST["req"] == "admin_panel_login"){
            $Admin = new GPApiUser(array(
                "api_email" => "ahmet@obarey.com",
                "api_password" => "wazzabii308",
                "api_admin_panel_login" => true
            ));
            var_dump( $Admin->getStatusFlag());
            echo "<br>" . $Admin->getReturnText();
            die;
        }
    }

    function loginPage(){
        echo '<h3>Admin Panel Login</h3>
        <form action="" method="post">
            <input type="hidden" name="email" value="ahmet@obarey.com"/>
            <input type="hidden" name="password" value="wazzabii308" />
            <input type="hidden" name="req" value="admin_panel_login" />
            <input type="submit" />
        </form>';
    }

    // check login state
    function adminPanelLoggedInCheck(){
        return isset($_SESSION["admin_panel_loggedin"]) && isset( $_SESSION["admin_panel_user"]);
    }

    if( !adminPanelLoggedInCheck() ){
        loginPage();
    } else {
        if( GPApiAdminSessionToken::validate() ){
            GPApiAdminSessionToken::refreshToken( $_SESSION["admin_panel_user_id"]);
        } else {
            loginPage();
            die;
        }
        function fetch(){
            $Admin = new GPApiUser(2);
            var_dump( $Admin->getStatusFlag());
            echo "<br>" . $Admin->getReturnText();
        }

        function main(){
            fetch();
        }


        echo '<pre>';

        main();



        echo "<br>" . $_SESSION[GPApiAdminSessionToken::$KEY];



    }





