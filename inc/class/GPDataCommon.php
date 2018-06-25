<?php
    /* Gitaş - Obarey Inc. 2018 */

    /*  GPDataCommon
	*
	*	dependencies:
	*		- GPFormValidation.php
	*
	*   - this is a common super class for database connected objects */
	class GPDataCommon {
		protected
			// PDO object
			$pdo,
			// database table name
			$table,
            // database archive table name if exists
            $archiveTable,
			// status text
			$returnText,
			// array to keep object data
			$details = array(),
			// status flag ( can be used with action, db check )
			$ok = false,
			// db - form keys
			// this is for automated input checks for db add, update actions
			// must contain all cols of the table except id
			$dbFormKeys = array(),
            // for classses that has archive tables, flag to determine
            // which table to fetch data
            $archiveFlag = false,
            // api trigger vars
            $apiTriggerType,
            $apiTriggerKey;
		/*
		*   constructor for GPDataCommon
		*		@table : database table name
		*	   	@keys  : database column names to be searched
		*	   	@val   : unique record data to fetch ( WHERE key = val ) ( can be null )
		*/ 
		public function __construct( $table, $keys, $val = null ){
			$this->pdo = DB::getInstance();
			// set table according to archiveFlag
			( $this->archiveFlag ) ? $this->table = $this->archiveTable : $this->table = $table;
			// if search value is set, we look for it in the database
			if( isset($val) ){
				// we search for each unique key
				foreach( $keys as $key ){
                    // if we look for an archive record, we replace 'id' col with 'prev_id'
                    // because id on the archive table has no meaning, we look for id that record had
                    // on the real table
				    if( $this->archiveFlag ) if( $key == "id" ) $key = "prev_id";
					$query = $this->pdo->query("SELECT * FROM " . $this->table . " WHERE " . $key . " = ?", array( $val ) )->results();
					if( count( $query ) == 1 ){
						$this->details = $query[0];
						$this->ok = true;
						return;
					}
				}
				$this->returnText = "Böyle bir kayıt yok. ( table : ".$this->table." )";
			}
		}
		/*
		*	deletes a record from the database
		*	( can be overriden by the child class )
		*		@input : request parameters
		*/
		public function delete(){
		    // reset action flag
		    $this->ok = false;
			$this->pdo->query("DELETE FROM " . $this->table . " WHERE id = ?", array($this->details["id"]));
			if( $this->pdo->error() ){
				$this->returnText = "DB Hatası.[".$this->pdo->getErrorMessage()."]";
				return;
			}
			// clear data from object
			$this->details = array();
			$this->ok = true;
			$this->returnText = GPFormValidation::$SUCCESS_MESSAGE;
		}

		/*
		*  keeps the record on the table only making it deleted = 1
		*  we do this to not lost or cause an exception when dealing with previous definitons related to this object
		*/
		public function softDelete(){
		    $this->ok = false;
			$this->pdo->query("UPDATE " . $this->table . " SET deleted = ? WHERE id = ?", array( 1, $this->details["id"] ) );
			if( $this->pdo->error() ){
				$this->returnText = "DB Hatası.[".$this->pdo->getErrorMessage()."]";
				return;
			}
			// clear data from object
			$this->details = array();
			$this->ok = true;
			$this->returnText = GPFormValidation::$SUCCESS_MESSAGE; 
		}

		/*
		*	database edit method, based on dbFormKeys defined in object's own constructor.
		*	( can be overriden by the child class )
		*		@input : request parameters
		*/
		public function edit( $input ){
		    $this->ok = false;
			$updateKeys = array();
			$updateVals = array();
			foreach( $this->dbFormKeys as $key => $value ){
                // if non required key is not within the input skip it
                if( !isset( $input[$key] ) && !isset($value["validation"]["req"]) ) continue;
                // if required input is not within $_POST
                if( !isset($input[$key])){
                    $this->returnText = $value["label"] . " verisi yok.";
                    return;
                }
				// 1 - validation check
				if( isset($value["validation"] ) ){
					$Validation = new GPFormValidation;
					foreach( $value["validation"] as $validationKey => $ruleValue ){
						if( !$Validation->check( $validationKey, $input[$key], $ruleValue, $value["label"] ) ){
							$this->returnText = $Validation->getErrorMessage();
							return;
						}
					}
				}
				if( isset($value["unique"] ) ){
					// difference with this and add method's unique check action is that, we check the uniqness of the record 
					// by excluding it from other records
					$q = $this->pdo->query("SELECT * FROM " . $this->table . " WHERE " . $key . " = ? &&  ".$key." != ?",
						array( $input[$key], $this->details[$key] ))->results();
					if( count($q) > 0 ){
						$this->returnText = GPFormValidation::outErrorMessage( GPFormValidation::$ERROR_KEY_UNIQUE, $value["label"] );
						return;
					}
				}
				// add vals and keys to collection
				$updateKeys[] = $key;
				$updateVals[] = $input[$key];
			}
			// update the database
			$this->pdo->query("UPDATE " . $this->table . " SET " . implode(" = ?, " , $updateKeys ) . " = ? WHERE id = ?",
				array_merge($updateVals, array( $this->details["id"] ) ));
			if( $this->pdo->error() ){
				$this->returnText = "DB Hatası.[".$this->pdo->getErrorMessage()."]";
				return;
			}
			$this->ok = true;
			$this->returnText = GPFormValidation::$SUCCESS_MESSAGE;
		}
		/*
		*	database add method, based on dbFormKeys defined in object's own constructor
		*	( can be overriden by the child class )
		*		@input : request parameters
		*/
		public function add( $input ){
			$insertArray = array();
			foreach( $this->dbFormKeys as $key => $value ){
				// if non required key is not within the input skip it
				if( !isset( $input[$key] ) && !isset($value["validation"]["req"]) ) continue;
				// if required input is not within $_POST
                if( !isset($input[$key])){
                    $this->returnText = $value["label"] . " verisi yok.";
                    return;
                }
				// 1 - validation check
				if( isset($value["validation"] ) ){
					$Validation = new GPFormValidation;
					foreach( $value["validation"] as $validationKey => $ruleValue ){
						if( !$Validation->check( $validationKey, $input[$key], $ruleValue, $value["label"] ) ){
							$this->returnText = $Validation->getErrorMessage();
							return;
						}
					}
				}
				// 2 - before any db update, check for uniqness of the value
				if( isset($value["unique"] ) ){
					$q = $this->pdo->query("SELECT * FROM " . $this->table . " WHERE " . $key . " = ?", array( $input[$key] ))->results();
					if( count($q) > 0 ){
						$this->returnText = GPFormValidation::outErrorMessage( GPFormValidation::$ERROR_KEY_UNIQUE, $value["label"] );
						return;
					}
				}
				// input is ok, save it
				$insertArray[$key] = $input[$key];
			}
			$this->pdo->insert( $this->table, $insertArray );
			if( $this->pdo->error() ){
				$this->returnText = "DB Hatası.[".$this->pdo->getErrorMessage()."]";
				return;
			}
			// get the inserted record's ID
			$this->details["id"] = $this->pdo->lastInsertedId();
			$this->ok = true;
			$this->returnText = GPFormValidation::$SUCCESS_MESSAGE;
		}

		/*
		 *  update columns of DB record of object
		 * */
		public function editCol( $input ){
		    $this->ok = false;
		    foreach( $input as $key => $value ){
		        $this->pdo->query("UPDATE " . $this->table . " SET ".$key." = ? WHERE id = ?", array( $value, $this->details["id"] ) );
		        if( $this->pdo->error() ){
		            $this->returnText = $this->pdo->getErrorMessage();
		            break;
                }
                $this->details[$key] = $value;
            }
            $this->ok = true;
		    $this->returnText = "İşlem başarılı.";
        }

        /*
         *  - moves the record to archive table
         *
         * */
        public function moveToArchiveTable(){
            $insertArray = array(
                "prev_id" => $this->details["id"]
            );
            foreach( $this->details as $key => $val ){
                // check if key exists in the database table, just in case
                // if we added additional pair to the details array
                if( !isset($this->dbFormKeys[$key]) ) continue;
                $insertArray[$key] = $val;
            }
            $this->pdo->insert( $this->archiveTable, $insertArray );
            if( $this->pdo->error() ){
                $this->returnText = $this->pdo->getErrorMessage();
                return;
            }
            // remove record from actual table
            $this->delete();
            if( !$this->ok ) return;
            // save id for if additional actions will be done by child class
            $this->details["id"] = $insertArray["prev_id"];
            $this->ok = true;
        }

        /*
         *  - common api trigger insert method
         * */
        public function addApiTrigger( $actionType ){
            $this->ok = false;
            $ApiTrigger = new GPApiTrigger();
            $ApiTrigger->add(array(
                "item_type"         => $this->apiTriggerType,
                "item_action_type"  => $actionType,
                "item_id"           => $this->details["id"],
                "item_key"          => $this->apiTriggerKey
            ));
            if( !$ApiTrigger->getStatusFlag() ){
                $this->returnText = $ApiTrigger->getReturnText();
                return;
            }
            $this->ok = true;
        }
		/* getter for status text */
		public function getReturnText(){
			return $this->returnText;
		}
		/* getter for status flag */
		public function getStatusFlag(){
			return $this->ok;
		}
		/*
		*	details getter function
		*		@key : if set, returns the specified key's data, else return whole details array
		*/
		public function getDetails( $key = null ){
			if( isset($key) ){
				if( isset($this->details[$key])) return $this->details[$key];
				return "[UNDEFINED DATA]";				
			}
			return $this->details;
		}
	}