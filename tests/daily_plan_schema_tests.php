<?php
    /* Gitaş - Obarey Inc. 2018 */

    require '../inc/defs.php';

    require CLASS_DIR . "GPFormValidation.php";
    require CLASS_DIR . "GPDataCommon.php";
    require CLASS_DIR . "GPEmployeeDailyPlanSchema.php";

    function add(){

        $Schema = new GPEmployeeDailyPlanSchema;
        $Schema->add( array(
            "name" => "Test isim",
            "start" => "08:00",
            "end" => "17:00",
            "plan_interval" => "100"
        ));
        var_dump( $Schema->getStatusFlag() );
        echo '<br>' . $Schema->getReturnText();

    }


    function main(){
        add();
    }


    main();