<?php
    /* Gitaş - Obarey Inc. 2018 */
    class GPEmployeeWork extends GPDataCommon {
        public static $STATUS_ACTIVE = 0,
                      $STATUS_COMPLETED = 1,
                      $STATUS_EXPIRED = 2,
                      $STATUS_CANCELED = 3;
        public function __construct( $val = null, $archive = false ){
            if( isset($val) && isset($archive) && $archive ) $this->archiveFlag = true;
            $this->archiveTable = DBT_GPEMPLOYEEWORKSARCHIVE;
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
                "due_date" => array(
                    "label" 		=> "Bitiş Tarihi"
                ),
                "date_last_modified" => array(
                    "label" 		=> "Son Düzenlenme Tarihi"
                ),
                "added_employee" => array(
                    "label" 		=> "Ekleyen Personel",
                    "validation" 	=> array( "req" => true )
                ),
                "sub_items" => array(
                    "label" 		=> "Alt Adımlar"
                )
            );
        }

        public function add( $input ){
            // first add the task to the database
            $input["date_added"] = Common::getCurrentDateTime();
            $input["added_employee"] = Client::getUser()->getDetails("id");
            $input["date_last_modified"] = Common::getCurrentDateTime();
            // for desktop app
            $this->details["date_added"] = $input["date_added"];
            $this->details["date_last_modified"] = $input["date_last_modified"];
            if( !parent::add( $input ) ) return false;
            $subItems = explode( "|", $input["sub_items_encoded"] );
            foreach( $subItems as $itemEncoded ){
                // add parent work id to encoded string
                $itemEncoded .= "#parent_work_id=".$this->details["id"];
                $GWorkSubItem = new GPEmployeeWorkSubItem();
                if( !$GWorkSubItem->add( $itemEncoded ) ){
                    $this->returnText = $GWorkSubItem->getReturnText();
                    return false;
                }
            }
            return true;
        }

        public function edit( $input ){
            $input["added_employee"] = Client::getUser()->getDetails("id");
            $input["date_last_modified"] = Common::getCurrentDateTime();
            if( !parent::edit( $input ) ) return false;
            $subItems = explode( "|", $input["sub_items_encoded"] );
            // download subItems for comparasion
            $this->fetchSubItems();
            // will use these two arrays to determine newly added and deleted subItems
            $existingSubItemsIDArray = array();
            $clientSubItemsIDArray = array();
            $clientSubItemData = array();
            foreach( $this->details["sub_items"] as $item ) $existingSubItemsIDArray[] = $item["id"];
            foreach( $subItems as $itemEncoded ){
                // add parent work id to encoded string
                $itemEncoded .= "#parent_work_id=".$this->details["id"];
                $params = explode("#", $itemEncoded);
                $idExploded = explode( "=", $params[0] );
                // if id is submitted as 0, we add the subItem
                if( $idExploded == 0 ){
                    $GWorkSubItem = new GPEmployeeWorkSubItem();
                    if( !$GWorkSubItem->add( $itemEncoded ) ){
                        $this->returnText = $GWorkSubItem->getReturnText();
                        return false;
                    }
                } else {
                    // newly added subItems wont be included in comparasion
                    $clientSubItemsIDArray[] = $idExploded[1];
                    $clientSubItemData[] = $itemEncoded;
                }
            }
            // comparasion
            // since we ruled out newly added subItems, $clientSubItemsIDArray will only hold previously
            // existed subItems. So when we loop through already existing subItems, we can easily determine
            // which ones are deleted by checking if $clientSubItemsIDArray contains that subItem.
            $indexCounter = 0;
            foreach( $existingSubItemsIDArray as $existingSubItemID ){
                $GWorkSubItem = new GPEmployeeWorkSubItem( $existingSubItemID );
                if( in_array( $existingSubItemID, $clientSubItemsIDArray ) ){
                    // subItem is not been deleted
                    if( !$GWorkSubItem->edit( $clientSubItemData[$indexCounter] ) ){
                        $this->returnText = $GWorkSubItem->getReturnText();
                        return false;
                    }
                } else {
                    // subItem is been deleted
                    if( !$GWorkSubItem->delete() ){
                        $this->returnText = $GWorkSubItem->getReturnText();
                        return false;
                    }
                }
                $indexCounter++;
            }


            return true;
        }

        /*
         *  @$returnObjFlag = flag to determine return type ( GPEmployeeWorkSubItem(true) or assoc array(false) )
         * */
        public function fetchSubItems( $returnObjFlag = false ){
            $this->details["sub_items"] = array();
            if( $this->archiveFlag ){
                // todo archived works are holds their sub items in sub_items column

            } else {
                // fetch from db
                $query = $this->pdo->query("SELECT * FROM " . DBT_GPEMPLOYEEWORKSSUBITEMS . " WHERE parent_work_id = ? ORDER BY step_order DESC", array( $this->details["id"]))->results();
                if( $returnObjFlag ){
                    foreach( $query as $subItemData ) $this->details["sub_items"][] = new GPEmployeeWorkSubItem( $subItemData );
                } else {
                    foreach( $query as $subItemData ) $this->details["sub_items"][] = $subItemData;
                }
            }
        }

        public function changeStatus( $newStatus ){
            $this->editCol( array("status" => $newStatus ) );
            if( $newStatus == self::$STATUS_COMPLETED ){
                // try to convert it to template if not already exists
                $convertOutput = GPEmployeeWorkTemplate::convert( $this );
                if( is_array( $convertOutput ) ){
                    $Template = new GPEmployeeWorkTemplate();
                    if( !$Template->add( $convertOutput ) ){
                        $this->returnText = $Template->getReturnText();
                        return false;
                    }
                    // we already fetchSubitems in Template::convert, so we can use it when
                    // moving item to archive
                    $this->details["sub_items"] = $convertOutput["sub_items"];
                    $subItemsTemp = json_decode( $convertOutput["sub_items"], true );
                }
                // move work data to archive
                if( !isset($this->details["sub_items"] ) ){
                    // if Template::convert is not performed, we fetch sub items and format them as json data
                    $this->fetchSubItems();
                    // keep a copy for deleting sub items from their tables
                    $subItemsTemp = $this->details["sub_items"];
                    $this->details["sub_items"] = json_encode( $this->details["sub_items"] );
                }
                if( !$this->moveToArchiveTable() ) return false;
                // remove all subitems from table
                foreach( $subItemsTemp as $subItemData ){
                    $SubItem = new GPEmployeeWorkSubItem( $subItemData["id"] );
                    $SubItem->delete();
                }
            } else if( $newStatus == self::$STATUS_EXPIRED ) {
                // todo
            }
            return true;
        }

    }