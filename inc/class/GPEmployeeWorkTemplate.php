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

    /*
     *  converts work to template and returns insert array
     * */
    public static function convert( GPEmployeeWork $workObject ){
        // check if template already exists
        $Template = new GPEmployeeWorkTemplate( $workObject->getDetails("name") );
        if( $Template->getStatusFlag() ) return false;
        // download subitems and convert them to json objects for db
        $workObject->fetchSubItems();
        return array(
            "name" => $workObject->getDetails("name"),
            "details" => $workObject->getDetails("details"),
            "sub_items" => json_encode($workObject->getDetails("sub_items"))
        );
    }

}