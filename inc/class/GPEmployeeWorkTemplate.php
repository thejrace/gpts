<?php

class GPEmployeeWorkTemplate extends GPDataCommon {

    // when work is completed, it will be added as an template if not already been saved before
    public function __construct( $val = null ){
        parent::__construct( DBT_GPEMPLOYEEWORKTEMPLATES, array( "id", "name" ), $val );
        $this->dbFormKeys = array(
            "name" => array(
                "label" 		=> "İsim",
                "validation" 	=> array( "req" => true )
            ),
            "details" => array(
                "label" 		=> "Açıklama"
            ),
            "sub_items" => array(
                "label" 		=> "Adımlar",
                "validation" 	=> array( "req" => true )
            )
        );

    }




}