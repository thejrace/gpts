<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPApiUserDevice - API User's mobile - computer device class
    *
    *  dependencies:
    *		- GPDataCommon.php
    */

    class GPApiUserDevice extends GPDataCommon {

        public function __construct( $val = null ){
            parent::__construct( DBT_APIUSERDEVICES, array( "id", "hash" ), $val );
            $this->dbFormKeys = array(
                "user_id" => array(
                    "label" 		=> "Kullanıcı ID",
                    "unique" => true,
                    "validation" 	=> array( "req" => true )
                ),
                "type" => array(
                    "label" 		=> "Cihaz Tipi",
                    "validation" 	=> array( "req" => true, "posnum" => true )
                ),
                "name" => array(
                    "label" 		=> "Cihaz Adı",
                    "validation" 	=> array( "req" => true )
                ),
                "hash" => array(
                    "label" 		=> "Cihaz Hash",
                    "validation" 	=> array( "req" => true )
                ),
                "ip" => array(
                    "label" 		=> "Cihaz IP",
                    "validation" 	=> array( "req" => true )
                ),
                "os" => array(
                    "label" 		=> "Cihaz OS",
                    "validation" 	=> array( "req" => true )
                ),
                "date_added" => array(
                    "label" 		=> "Cihaz Eklenme Tarihi",
                    "validation" 	=> array( "req" => true )
                ),
                "date_last_connected" => array(
                    "label" 		=> "Cihaz Son Bağlantı",
                    "validation" 	=> array( "req" => true )
                ),
                "status" => array(
                    "label" 		=> "Cihaz Durum",
                    "validation" 	=> array( "req" => true )
                )
            );
        }

        public function updateLastConnectNow(){
            $this->editCol(array(
                "date_last_connected" => Common::getCurrentDateTime()
            ));
        }

    }