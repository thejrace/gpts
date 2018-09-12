<?php

class GPEmployeeWorkDefinition extends GPDataCommon {


    public function __construct( $val = null, $archive = false ){
        if( isset($val) && isset($archive) && $archive ) $this->archiveFlag = true;
        $this->archiveTable = DBT_GPEMPLOYEEWORKDEFINITIONSARCHIVE;
        parent::__construct( DBT_GPEMPLOYEEWORKDEFINITIONS, array( "id" ), $val );
        $this->dbFormKeys = array(
            "employee_id" => array(
                "label" 		=> "Personel ID",
                "validation" 	=> array( "req" => true )
            ),
            "work_template_id" => array(
                "label" 		=> "İş Şablon ID",
                "validation" 	=> array( "req" => true )
            ),
            "start" => array(
                "label" 		=> "Başlangıç",
                "validation" 	=> array( "req" => true  )
            ),
            "time_length" => array(
                "label" 		=> "Süre",
                "validation" 	=> array( "req" => true, "posnum" => true  )
            ),
            "end" => array(
                "label" 		=> "Bitiş",
                "validation" 	=> array( "req" => true )
            ),
            "date_added" => array(
                "label" 		=> "Eklenme Tarihi",
                "validation" 	=> array( "req" => true  )
            ),
            "date_last_update" => array(
                "label" 		=> "Son Güncellenme Tarihi",
                "validation" 	=> array( "req" => true )
            ),
            "added_employee" => array(
                "label" 		=> "Ekleyen",
                "validation" 	=> array( "req" => true )
            ),
            "status" => array(
                "label" 		=> "Durum"
            ),
            "deleted" => array(
                "label" 		=> "Silinmiş"
            )
        );
    }

}