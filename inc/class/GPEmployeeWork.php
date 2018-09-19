<?php
    /* Gitaş - Obarey Inc. 2018 */
    class GPEmployeeWork extends GPDataCommon {
        public static $STATUS_ACTIVE = 0,
                      $STATUS_COMPLETED = 1,
                      $STATUS_EXPIRED = 2,
                      $STATUS_CANCELED = 3,
                      $STATUS_PENDING  = 4; // this status only for server-side
        public function __construct( $val = null, $archive = false ){
            if( isset($val) && isset($archive) && $archive ) $this->archiveFlag = true;
            $this->archiveTable = DBT_GPEMPLOYEEWORKSARCHIVE;
            parent::__construct( DBT_GPEMPLOYEEWORKS, array( "id" ), $val );
            $this->dbFormKeys = array(
                "name" => array(
                    "label" 		=> "İsim",
                    "validation" 	=> array( "req" => true )
                ),
                "employee_id" => array(
                    "label" 		=> "Tanımlanan Personel"
                ),
                "status" => array(
                    "label" 		=> "Durum"
                ),
                "details" => array(
                    "label" 		=> "Açıklama"
                ),
                "date_added" => array(
                    "label" 		=> "Eklenme Tarihi [ GWork ]"
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
            if( !isset($input["date_added"] ) ) $input["date_added"] = Common::getCurrentDateTime();
            $input["added_employee"] = Client::getUser()->getDetails("id");
            // if employee defined his/her job employee_id is not submitted
            // if it's defined to the employee, it will be included in the form
            if( !isset($input["employee_id"]) ) $input["employee_id"] = $input["added_employee"];
            $input["date_last_modified"] = Common::getCurrentDateTime();
            // for desktop app
            /*$this->details["date_added"] = $input["date_added"];
            $this->details["date_last_modified"] = $input["date_last_modified"];*/
            if( !parent::add( $input ) ) return false;
            if( $input["sub_items_encoded"] != "" ){
                $subItems = explode( "|", $input["sub_items_encoded"] );
                foreach( $subItems as $itemEncoded ){
                    // add parent work id to encoded string
                    $itemEncoded .= "#parent_work_id=".$this->details["id"];
                    $GWorkSubItem = new GPEmployeeWorkSubItem();
                    if( !$GWorkSubItem->add( $itemEncoded ) ){
                        $this->returnText = $GWorkSubItem->getReturnText();
                        return false;
                    }
                    if( $GWorkSubItem->getDetails("status") == GPEmployeeWorkSubItem::$STATUS_ACTIVE ||
                        $GWorkSubItem->getDetails("status") == GPEmployeeWorkSubItem::$STATUS_WAITING
                    ){
                        if( $input["status"] == GPEmployeeWork::$STATUS_COMPLETED  ){
                            $GWorkSubItem->editCol(array("status" => GPEmployeeWorkSubItem::$STATUS_COMPLETED ) );
                        } else if( $input["status"] == GPEmployeeWork::$STATUS_CANCELED ){
                            $GWorkSubItem->editCol(array("status" => GPEmployeeWorkSubItem::$STATUS_CANCELED ) );
                        } else if( $input["status"] == GPEmployeeWork::$STATUS_EXPIRED ){
                            $GWorkSubItem->editCol(array("status" => GPEmployeeWorkSubItem::$STATUS_EXPIRED ) );
                        }
                    }
                    // save newly added subitem's ID's with step order for desktop app
                    $this->details["added_sub_items_data"][] = array(
                        "status"        => $GWorkSubItem->getDetails("status"),
                        "step_order"    => $GWorkSubItem->getDetails("step_order"),
                        "id"            => $GWorkSubItem->getDetails("id")
                    );
                }
            }
            // perform extra status actions
            $this->changeStatus($input["status"]);
            return true;
        }

        public function edit( $input ){
            $input["added_employee"] = Client::getUser()->getDetails("id");
            $input["date_last_modified"] = Common::getCurrentDateTime();
            if( !parent::edit( $input ) ) return false;
            if( $input["sub_items_encoded"] != "" ){
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
                    if( $idExploded[1] == 0 ){
                        $GWorkSubItem = new GPEmployeeWorkSubItem();
                        if( !$GWorkSubItem->add( $itemEncoded ) ){
                            $this->returnText = $GWorkSubItem->getReturnText();
                            return false;
                        }
                    } else {
                        // newly added subItems wont be included in comparasion
                        $clientSubItemsIDArray[] = $idExploded[1];
                        $clientSubItemData[$idExploded[1]] = $itemEncoded;
                    }
                }
                // comparasion
                // since we ruled out newly added subItems, $clientSubItemsIDArray will only hold previously
                // existed subItems. So when we loop through already existing subItems, we can easily determine
                // which ones are deleted by checking if $clientSubItemsIDArray contains that subItem.
                foreach( $existingSubItemsIDArray as $existingSubItemID ){
                    $GWorkSubItem = new GPEmployeeWorkSubItem( $existingSubItemID );
                    if( in_array( $existingSubItemID, $clientSubItemsIDArray ) ){
                        // subItem is not been deleted
                        if( !$GWorkSubItem->edit( $clientSubItemData[$existingSubItemID] ) ){
                            $this->returnText = $GWorkSubItem->getReturnText();
                            return false;
                        }
                        // GWork has certain states that will inherit to it's !!waiting or active!! subItems ( completed, canceled, expired )
                        // when those states will occur we change subItems status manually because;
                        // $clientSubItemData[$existingSubItemID] is an encoded string, so it's hard to change status data.
                        // therefore after edit action, we manually edit status col of subItem
                        if( $GWorkSubItem->getDetails("status") == GPEmployeeWorkSubItem::$STATUS_ACTIVE ||
                            $GWorkSubItem->getDetails("status") == GPEmployeeWorkSubItem::$STATUS_WAITING
                        ){
                            if( $input["status"] == GPEmployeeWork::$STATUS_COMPLETED  ){
                                $GWorkSubItem->editCol(array("status" => GPEmployeeWorkSubItem::$STATUS_COMPLETED ) );
                            } else if( $input["status"] == GPEmployeeWork::$STATUS_CANCELED ){
                                $GWorkSubItem->editCol(array("status" => GPEmployeeWorkSubItem::$STATUS_CANCELED ) );
                            } else if( $input["status"] == GPEmployeeWork::$STATUS_EXPIRED ){
                                $GWorkSubItem->editCol(array("status" => GPEmployeeWorkSubItem::$STATUS_EXPIRED ) );
                            }
                        }
                    } else {
                        // subItem is been deleted
                        if( !$GWorkSubItem->delete() ){
                            $this->returnText = $GWorkSubItem->getReturnText();
                            return false;
                        }
                    }
                }
            }
            // perform extra status change actions
            $this->changeStatus($input["status"]);
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
                $query = $this->pdo->query("SELECT * FROM " . DBT_GPEMPLOYEEWORKSSUBITEMS . " WHERE parent_work_id = ? ORDER BY step_order ASC", array( $this->details["id"]))->results();
                if( $returnObjFlag ){
                    foreach( $query as $subItemData ) $this->details["sub_items"][] = new GPEmployeeWorkSubItem( $subItemData );
                } else {
                    foreach( $query as $subItemData ) $this->details["sub_items"][] = $subItemData;
                }
            }
        }

        /*
         *  will be called from add and edit methods
         *  */
        public function changeStatus( $newStatus ){
            // no further actions required for active work
            if( $newStatus == self::$STATUS_ACTIVE || $newStatus == self::$STATUS_PENDING ) return true;
            // a lot of stuff happening in add and edit
            // avoid any confusion, just fetch last updated subItem data
            $this->fetchSubItems();
            // try to convert it to template if not already exists
            $convertOutput = GPEmployeeWorkTemplate::convert( $this );
            if( is_array( $convertOutput ) ){
                $Template = new GPEmployeeWorkTemplate();
                if( !$Template->add( $convertOutput ) ){
                    $this->returnText = $Template->getReturnText();
                    return false;
                }
            }
            // remove all subitems from table
            foreach( $this->details["sub_items"] as $subItemData ){
                $SubItem = new GPEmployeeWorkSubItem( $subItemData["id"] );
                $SubItem->delete();
            }
            // move work data to archive with subItems encoded as jsonarray
            $this->details["sub_items"] = json_encode( $this->details["sub_items"] );
            if( !$this->moveToArchiveTable( false ) ) return false;
            return true;
        }

    }