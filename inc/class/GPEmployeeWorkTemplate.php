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
        $subItems = $workObject->getDetails("sub_items");
        foreach( $subItems as $key => $val ){
            // these are not needed for template
            unset( $subItems[$key]["parent_work_id"] );
            unset( $subItems[$key]["id"] );
            unset( $subItems[$key]["needs_validation"] );
            unset( $subItems[$key]["date_added"] );
            unset( $subItems[$key]["added_employee"] );
            unset( $subItems[$key]["date_last_modified"] );
            unset( $subItems[$key]["status"] );
        }
        return array(
            "name" => $workObject->getDetails("name"),
            "details" => $workObject->getDetails("details"),
            "sub_items" => json_encode($subItems)
        );
    }

    public static function searchForDesktopApp( $keyword, $colsToFetch, $rrp, $startIndex, $orderBy ){
        $q = GPDBFetch::search(DBT_GPEMPLOYEEWORKTEMPLATES, $colsToFetch,
            array(
                "limit"         => $rrp,
                "start_index"   => $startIndex,
                "order_by"      => $orderBy
            ),
            array("key" => "name", "keyword" => $keyword )
        );
        foreach ($q as $key => $val) $q[$key]["sub_items"] = json_decode($q[$key]["sub_items"], true);
        return $q;
    }

    public static function getForDesktopApp( $colsToFetch, $rrp, $startIndex, $orderBy ){
        $q = GPDBFetch::action(DBT_GPEMPLOYEEWORKTEMPLATES, $colsToFetch,
            array(
                "limit"         => $rrp,
                "start_index"   => $startIndex,
                "order_by"      => $orderBy
            ));
        foreach ($q as $key => $val) $q[$key]["sub_items"] = json_decode($q[$key]["sub_items"], true);
        return $q;
    }

    /*
     *  used to download template from GWorkForm add
     * */
    public static function search( $keyword, $colsToFetch = array( "name", "details", "sub_items") ){
        return GPDBFetch::search(DBT_GPEMPLOYEEWORKTEMPLATES, $colsToFetch,
            array(
                "order_by" => array("name ASC")
            ),
            array( "key" => "name", "keyword" => $keyword )
        );
    }

}