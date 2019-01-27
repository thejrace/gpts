<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployeeGroup - base employee group class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		
	*/

	class GPEmployeeGroup extends GPDataCommon {

		public function __construct( $val = null ){
			parent::__construct( DBT_GPEMPLOYEEGROUPS, array( "id", "name" ), $val );
            $this->apiTriggerKey = "name";
            $this->apiTriggerType = 3;
            $this->cacheDataFileName = "employee_groups.cache";
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"name" => array(
					"label" 		=> "İsim",
					"unique"		=> true,
					"validation" 	=> array( "req" => true )
				),
                "parent" => array(
                    "label" 		=> "Üst Grup"
                ),
                "permissions" => array(
                    "label" 		=> "İzinler",
                    "validation" 	=> array( "req" => true )
                ) // todo cache de olmayacak
			);
		}

		public function delete( $clearDetailsProp = true ){
		    $check = $this->pdo->query("SELECT * FROM " . DBT_GPEMPLOYEES . " WHERE employee_group = ?", array( $this->details["id"]))->results();
		    if( count($check) > 0 ){
		        $this->returnText = "Bu gruba dahil personeller mevcut. Silmek için, önce bu grup personellerini transfer edin.";
		        return false;
            }
            if( !parent::delete() ) return false;
		    return true;
        }

        public function downloadEmployees(){
		    return $this->pdo->query("SELECT * FROM " . DBT_GPEMPLOYEES . " WHERE employee_group = ? && deleted = ?", array( $this->details["id"], 0 ) )->results();
        }

	}