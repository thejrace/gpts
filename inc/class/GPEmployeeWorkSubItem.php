<?php
/* Gitaş - Obarey Inc. 2018 */
class GPEmployeeWorkSubItem extends GPDataCommon {

    public static
        $STATUS_WAITING = 0,
        $STATUS_ACTIVE = 1,
        $STATUS_WAITS_VALIDATION = 2,
        $STATUS_WAITS_CANCELED = 3,
        $STATUS_COMPLETED = 4;

    public function __construct( $val = null ){
        if( is_array($val) ){
            // creating object with already existed data
            $this->details = $val;
            $this->ok = true;
            $this->table = DBT_GPEMPLOYEEWORKSSUBITEMS;
        } else {
            parent::__construct( DBT_GPEMPLOYEEWORKSSUBITEMS, array( "id" ), $val );
        }
        $this->dbFormKeys = array(
            "name" => array(
                "label" 		=> "İsim",
                "validation" 	=> array( "req" => true )
            ),
            "parent_work_id" => array(
                "label" 		=> "Üst İş ID",
                "validation" 	=> array( "req" => true )
            ),
            "status" => array(
                "label" 		=> "Durum"
            ),
            "details" => array(
                "label" 		=> "Açıklama"
            ),
            "needs_validation" => array(
                "label" 		=> "Onay Bekliyor",
                "validation" 	=> array( "posnum" => true )
            ),
            "step_order" => array(
                "label" 		=> "Sıra",
                "validation" 	=> array( "req" => true, "posnum" => true )
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

    /*
     *  @input -> params are seperated with # ( name=x#details=y#... )
     * */
    public function add( $input, $addToExistingWork = false ){
        $paramsOrdered = array(
            "date_added"          => Common::getCurrentDateTime(),
            "added_employee"      => Client::getUser()->getDetails("id"),
            "date_last_modified"  => Common::getCurrentDateTime()
        );
        $params = explode("#", $input);
        if( $addToExistingWork ){

            // additional param here is parentWorkID

            foreach( $params as $param ){
                $data = explode("=", $param );
                $paramsOrdered[ $data[0] ] = $data[1];
            }
        } else {
            foreach( $params as $param ){
                $data = explode("=", $param );
                // we dont send status and validation data, instead we use their default val on the database
                //if( $data[0] == "status" || $data[0] == "needs_validation" ) continue;
                $paramsOrdered[ $data[0] ] = $data[1];
            }
        }
        if( !parent::add( $paramsOrdered ) ) return false;
        return true;
    }


}