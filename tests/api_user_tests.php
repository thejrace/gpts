<?php
    /* Gitaş - Obarey Inc. 2018 */

    require '../inc/defs.php';

    require CLASS_DIR . "GPFormValidation.php";
    require CLASS_DIR . "GPDataCommon.php";
    require CLASS_DIR . "GPApiAdminSessionToken.php";
    require CLASS_DIR . "GPApiUser.php";


    function add(){
        $User = new GPApiUser;
        $User->add(array(
            "email"         => "test@obarey.com",
            "password"      => "123",
            "date_added"    => Common::getCurrentDateTime(),
            "user_group"    => GPApiUser::$NORMAL,
            "status"        => 1
        ));
        var_dump( $User->getStatusFlag());
        echo "<br>" . $User->getReturnText();
    }

    function fetch(){
        $User = new GPApiUser(12);
        var_dump( $User->getStatusFlag() );
        echo '<br>' . $User->getReturnText() . "<br>";
        print_r($User->getDetails() );
    }

    function main(){
        add();
    }

    echo '<pre>';
    echo $_SESSION[GPApiAdminSessionToken::$KEY] . "<br>";

    main();