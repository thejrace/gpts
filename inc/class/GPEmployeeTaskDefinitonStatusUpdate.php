<?php
	
	/* GPEmployeeTaskDefinitonStatusUpdate - base task def status update class
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- GPDataCommon.php
	*		- GPEmployee.php
	*		- GPTask.php
	*/

	class GPEmployeeTaskDefinitonStatusUpdate extends GPDataCommon {
		
		public function __construct( $val = null ){
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