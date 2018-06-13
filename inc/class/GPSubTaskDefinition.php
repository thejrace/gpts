<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPSubTaskDefinition - base sub task ( bundle ) definition class
	*
	*  dependencies:
	*		- GPDataCommon.php
	*/
	class GPSubTaskDefinition extends GPDataCommon {

		public function __construct( $val = null ){
			parent::__construct( DBT_GPSUBTASKDEFINITIONS, array( "id" ), $val );
			// unique groups should be on top to save time for unique checks
			$this->dbFormKeys = array(
				"parent_task_id" => array(
					"label" 		=> "Paket İş Tanımı",
					"validation" 	=> array( "req" => true )
				),
				"task_id" => array(
					"label" 		=> "Alt İş Tanımı",
					"validation" 	=> array( "req" => true )
				),
				"task_order" => array(
					"label" 		=> "İş Sırası",
					"validation" 	=> array( "req" => true, "posnum" => true )
				)
			);
		}
		
	}