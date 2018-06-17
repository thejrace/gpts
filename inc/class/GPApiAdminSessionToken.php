<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPApiAdminSessionToken - API Admin session token class for advanced permissions
    *
    *  dependencies:
    *		- GPDataCommon.php
    */

    class GPApiAdminSessionToken extends GPDataCommon {

        public static $KEY = "gpast";
        public function __construct( $val = null ){
            parent::__construct( DBT_ADMINSESSIONTOKENS, array( "token", "id" ), $val );
            $this->dbFormKeys = array(
                "token" => array(
                    "label" 		=> "Token",
                    "unique" => true,
                    "validation" 	=> array( "req" => true )
                ),
                "user_id" => array(
                    "label" 		=> "Kullanıcı ID",
                    "validation" 	=> array( "req" => true )
                ),
                "date_last_connected" => array(
                    "label" 		=> "Son Bağlantı",
                    "validation" 	=> array( "req" => true )
                )
            );

        }

        /*
         *  - checks if the session exists
         * */
        private static function checkExists(){
            return isset($_SESSION[self::$KEY]);
        }

        /*
         * - check if client has an admin token locally and remotely
         *
         * */
        public static function validate(){
            if( self::checkExists() ){
                $checkQuery = DB::getInstance()->query("SELECT * FROM " . DBT_ADMINSESSIONTOKENS . " WHERE token = ?", array( $_SESSION[self::$KEY]))->results();
                if( count($checkQuery) != 1 ){
                    // todo - > log; attempted to inject invalid session token
                    return false;
                } else {
                    return true;
                }
            }
            return false;
        }

        /*
         *  - refreshes the token with each request
         *    @userID : api admin ID
         * */
        public static function refreshToken( $userID ){
            $PreviousToken = new GPApiAdminSessionToken( $_SESSION[self::$KEY]);
            $PreviousToken->delete();
            $NewToken = new GPApiAdminSessionToken;
            $NewToken->add(array(
                "user_id"               => $userID,
                "date_last_connected"   => Common::getCurrentDateTime()
            ));
        }

        /*
         *  - adds new token, if success; sets session
         * */
        public function add( $input ){
            $token = Common::generateUniqueRandomString($this->table, "token", 30 );
            $input["token"] = $token;
            parent::add( $input );
            if( !$this->getStatusFlag() ) return;
            // set session
            $_SESSION[self::$KEY] = $token;
        }



    }