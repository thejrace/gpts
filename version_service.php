<?php
    /* Gitaş - Obarey Inc. 2018 */
    /* main version service */
	require 'inc/defs.php';

	if( $_POST ) {

        $OK = 1;
        $TEXT = "";
        $DATA = array();

        switch ($_POST["req"]) {

            case 'update_check':

                require CLASS_DIR . "GPApiDesktopAppUpdateCheck.php";
                $Ver = new GPApiDesktopAppUpdateCheck($_POST["version_info"]);
                if ($Ver->getStatusFlag()) {
                    $OK = (int)$Ver->getDetails("last_stable");
                } else {
                    $OK = 0;
                }

                break;
        }


        die(json_encode(array(
            "ok" => $OK,
            "text" => $TEXT,
            "data" => $DATA,
            "oh" => $_POST
        )));
        
    }