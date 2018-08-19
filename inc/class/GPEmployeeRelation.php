<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPEmployeeRelation - base employee relation class
    *
    */

    class GPEmployeeRelation extends GPDataCommon {

        // NOTE: first param can also be ID
        public function __construct( $parentEmployee = null, $childEmployee = null ){
            if( isset($parentEmployee) && isset($childEmployee) ){
                // looking relation with two employees ID's
                $check = DB::getInstance()->query("SELECT * FROM " . DBT_GPEMPLOYEERELATIONS . " WHERE parent_employee = ? && child_employee = ?",
                    array( $parentEmployee, $childEmployee))->results();
                if( count($check) == 1 ){
                    $this->details = $check[0];
                    $this->ok = true;
                }
            } else {
                // regular check with ID
                parent::__construct( DBT_GPEMPLOYEERELATIONS, array( "id" ), $parentEmployee );
            }
            // unique groups should be on top to save time for unique checks
            $this->dbFormKeys = array(
                "parent_employee" => array(
                    "label" 		=> "Üst Personel ID",
                    "validation" 	=> array( "req" => true )
                ),
                "child_employee" => array(
                    "label" 		=> "Alt Personel ID",
                    "validation" 	=> array( "req" => true )
                )
            );
        }


    }