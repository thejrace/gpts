<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPEmployeeTaskDefinitionStatusUpdate - base task def status update class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		- GPEmployee.php
	*		- GPTask.php
	*/

	class GPEmployeeTaskDefinitionStatusUpdate extends GPDataCommon {
		
		public function __construct( $val = null, $archive = false ){
            if( isset($val) && isset($archive) && $archive ) $this->archiveFlag = true;
            $this->archiveTable = DBT_GPEMPLOYEETASKDEFINITIONSSTATUSUPDATESARCHIVE;
			parent::__construct( DBT_GPEMPLOYEETASKDEFINITIONSSTATUSUPDATES, array( "id", "name" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"work_task_definition_id" => array(
					"label" 		=> "İş Tanımı ID",
					"validation" 	=> array( "req" => true )
				),
				"type" => array(
					"label" 		=> "Bildirim Tipi",
					"validation" 	=> array( "req" => true )
				),
				"start" => array(
					"label" 		=> "Başlangıç",
					"validation" 	=> array( "req" => true  )
				),
				"comments" => array(
					"label" 		=> "Açıklama"
				),
				"date_added" => array(
					"label" 		=> "Eklenme Tarihi",
					"validation" 	=> array( "req" => true  )
				),
				"added_employee" => array(
					"label" 		=> "Ekleyen Personel",
					"validation" 	=> array( "req" => true  )
				)
			);
		}
	}