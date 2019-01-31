<?php
    /* Gitaş - Obarey Inc. 2018 */
    class GPApiDesktopAppUpdateCheck extends GPDataCommon {

        public function __construct( $val = null ){
            parent::__construct( DBT_GPAPIDESKTOPAPPUPDATES, array( "id", "version_info" ), $val );
            // unique groups should be on top to save time for unique checks
            $this->dbFormKeys = array(
                "version_info" => array(
                    "label" 		=> "Versiyon",
                    "unique"		=> true,
                    "validation" 	=> array( "req" => true )
                ),
                "details" => array(
                    "label" 		=> "Detaylar"
                ),
                "released" => array(
                    "label" 		=> "Tarih"
                ),
                "last_stable" => array(
                    "label"        => "Güncel"
                )
            );
        }

        public static function getLastStableVer(){
            $query = DB::getInstance()->query("SELECT * FROM " . DBT_GPAPIDESKTOPAPPUPDATES . " WHERE last_stable = ?", array( 1 ) )->results();
            return $query[0]["id"];
        }

    }