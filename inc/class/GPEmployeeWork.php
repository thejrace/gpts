<?php
    /* Gitaş - Obarey Inc. 2018 */
    class GPEmployeeWork extends GPDataCommon {





        public function __construct( $val = null){
            parent::__construct( DBT_GPEMPLOYEEWORKS, array( "id" ), $val );
            $this->dbFormKeys = array(
                "name" => array(
                    "label" 		=> "İsim",
                    "validation" 	=> array( "req" => true )
                ),
                "status" => array(
                    "label" 		=> "Durum"
                ),
                "details" => array(
                    "label" 		=> "Açıklama"
                ),
                "date_added" => array(
                    "label" 		=> "Eklenme Tarihi",
                    "validation" 	=> array( "req" => true )
                ),
                "added_employee" => array(
                    "label" 		=> "Ekleyen Personel",
                    "validation" 	=> array( "req" => true )
                )
            );
        }

        public function add( $input ){
            // first add the task to the database
            $input["date_added"] = Common::getCurrentDateTime();
            $input["added_employee"] = Client::getUser()->getDetails("id");
            if( !parent::add( $input ) ) return false;
            $subItems = explode( "|", $input["sub_items"] );
            foreach( $subItems as $itemEncoded ){
                $GWorkSubItem = new GPEmployeeWorkSubItem();
                if( !$GWorkSubItem->add( $itemEncoded ) ){
                    $this->returnText = $GWorkSubItem->getReturnText();
                    return false;
                }
            }
        }

        public function changeStatus( $newStatus ){

        }

    }