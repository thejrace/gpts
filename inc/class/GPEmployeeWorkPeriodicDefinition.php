<?php
    /* Gitaş - Obarey Inc. 2018 */
    class GPEmployeeWorkPeriodicDefinition extends GPDataCommon {

        public function __construct( $val = null ){
            // to check work template is already assigned to emp or emp group
            if( is_array($val) ){
                $this->table = DBT_GPEMPLOYEEWORKPERIODICDEFINITIONS;
                $check = DB::getInstance()->query("SELECT * FROM " . $this->table . " WHERE work_template_id = ? && " . $val["def_type_key"] . " = ?", array(
                    $val["work_template_id"], $val["def_type_id"]
                ))->results();
                if( count($check) > 0 ){
                    $this->ok = true;
                    $this->details = $check[0];
                }
            } else {
                parent::__construct( DBT_GPEMPLOYEEWORKPERIODICDEFINITIONS, array( "id" ), $val );
            }
            // unique groups should be on top to save time for unique checks
            $this->dbFormKeys = array(
                "work_template_id" => array(
                    "label" 		=> "İş Şablonu",
                    "validation" 	=> array( "req" => true )
                ),
                "employee_id" => array(
                    "label" 		=> "Personel ID"
                ),
                "employee_group_id" => array(
                    "label" 		=> "Personel Grubu ID"
                ),
                "start" => array(
                    "label" 		=> "Başlangıç"
                ),
                "time_length" => array(
                    "label" 		=> "Tamamlanma Süresi ( Dakika )"
                ),
                "define_interval" => array(
                    "label" 		=> "Tanımlanma Sıklığı"
                ),
                "date_last_defined" => array(
                    "label" 		=> "Son Tanımlanma"
                )
            );
        }

    }