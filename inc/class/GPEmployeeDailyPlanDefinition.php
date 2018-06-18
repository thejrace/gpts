<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPEmployeeDailyPlanDefinition - employee daily plan definition class
    *
    *  dependencies:
    *		- GPDataCommon.php
    *
    */
    class GPEmployeeDailyPlanDefinition extends GPDataCommon {

        public function __construct( $val = null ){
            parent::__construct( DBT_GPEMPLOYEEDAILYPLANDEFINITIONS, array( "id" ), $val );
            $this->dbFormKeys = array(
                "employee_id" => array(
                    "label" 		=> "Personel ID",
                    "validation" 	=> array( "req" => true )
                ),
                "daily_plan_schema_id" => array(
                    "label" 		=> "Plan ID",
                    "validation" 	=> array( "req" => true  )
                ),
                "date_added" => array(
                    "label" 		=> "Eklenme Tarihi",
                    "validation" 	=> array( "req" => true )
                ),
                "status" => array(
                    "label" 		=> "Durum"
                )
            );
        }

    }