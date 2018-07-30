<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPUser - API User class
    *
    *  dependencies:
    *		- GPDataCommon.php
    *       - GPApiAdminSessionToken.php
    *       - GPApiUserDevice.php
    */

    class GPApiUser extends GPDataCommon {

        private $passwordHashOptions = array( 'cost' => 12 );
        public static $ADMIN = 1, $NORMAL = 2;
        private $adminFlag = false;

        public function __construct( $val = null ){
            $this->dbFormKeys = array(
                "email" => array(
                    "label" 		=> "Eposta",
                    "unique" => true,
                    "validation" 	=> array( "req" => true, "email" => true )
                ),
                "password" => array(
                    "label" 		=> "Şifre",
                    "validation" 	=> array( "req" => true )
                ),
                "user_group" => array(
                    "label" 		=> "Grup",
                    "validation" 	=> array( "req" => true, "posnum" => true )
                ),
                "permissions" => array(
                    "label" 		=> "İzinler",
                    "validation" 	=> array( "req" => true )
                ),
                "date_added" => array(
                    "label" 		=> "Eklenme Tarihi",
                    "validation" 	=> array( "req" => true )
                ),
                "status" => array(
                    "label" 		=> "Durum",
                    "validation" 	=> array( "req" => true )
                )
            );
            if( !is_array( $val) ){
                // object class
                parent::__construct( DBT_APIUSERS, array( "id", "email" ), $val );
            } else {
                // login action
                $this->pdo = DB::getInstance();
                $this->table = DBT_APIUSERS;
                $this->ok = $this->login( $val );
            }
            /*if( GPApiAdminSessionToken::validate() ){
                // if class is created by system admin, we treat it like a regular data class
                parent::__construct( DBT_APIUSERS, array( "id", "email" ), $val );
                $this->adminFlag = true;
            } else {
                // if class is created by client, we ask them to login first
                $this->pdo = DB::getInstance();
                $this->table = DBT_APIUSERS;
                $this->ok = $this->login( $val );
            }*/
        }

        /*
         *  - apiuser login
         * */
        public function login( $input ){
            // in this case $val param is an array
            if( !is_array( $input ) ){
                $this->returnText = "Formda eksiklikler var.";
                return false;
            }
            // validate the inputs first
            $Validation = new GPFormValidation;
            $validFlag = $Validation->check( "req", $input["api_email"], true, "Eposta" ) &&
                         $Validation->check( "email", $input["api_email"], true, "Eposta" ) &&
                         $Validation->check( "req", $input["api_password"], true, "Şifre" );
            if( !$validFlag ){
                $this->returnText = $Validation->getErrorMessage();
                return false;
            }
            // email check
            $checkQuery = $this->pdo->query("SELECT * FROM " . $this->table . " WHERE email = ?", array($input["api_email"]))->results();
            if( count($checkQuery) == 0 ){
                $this->returnText = "Başarısız giriş.[1]";
                return false;
            }
            // password check
            if( !password_verify( $input["api_password"], $checkQuery[0]["password"] ) ){
                $this->returnText = "Başarısız giriş.[2]";
                return false;
            }
            $this->details = $checkQuery[0];
            // admin login from panel check
            if( /*isset($input["api_admin_panel_login"] ) &&*/ $this->details["user_group"] == self::$ADMIN ){
                $Token = new GPApiAdminSessionToken;
                $Token->add(array(
                    "user_id" => $this->details["id"],
                    "date_last_connected" => Common::getCurrentDateTime()
                ));
                $_SESSION["admin_panel_loggedin"] = true;
                $_SESSION["admin_panel_user"] = $this->details["email"];
                $_SESSION["admin_panel_user_id"] = $this->details["id"];
                /*$this->returnText = "Giriş başarılı.";
                return true;*/
            }
            // check inputs for device info
            $validFlagForDevices =
                isset( $input["api_device_hash"] ) &&
                isset( $input["api_device_type"] ) &&
                isset( $input["api_device_name"] ) &&
                isset( $input["api_device_os"] );
            if( !$validFlagForDevices ){
                $this->returnText = "Formda eksiklikler var.";
                return false;
            }
            // device check
            $Device = new GPApiUserDevice( $input["api_device_hash"] );
            if( $Device->getStatusFlag() ){
                if( $Device->getDetails("status") == 1 ){
                    $Device->updateLastConnectNow();
                    Client::init( $this, $Device );
                    $this->returnText = "Giriş başarılı.";
                    return true;
                } else {
                    $this->returnText = "Cihaz onayı gerek. Sistem yöneticinizle irtibata geçin.[1]";
                    return false;
                }
            } else {
                // device is not registered
                if( !$Device->add(array(
                    "user_id"               => $this->details["id"],
                    "type"                  => $input["api_device_type"],
                    "name"                  => $input["api_device_name"],
                    "hash"                  => $input["api_device_hash"],
                    "ip"                    => Common::getIP(),
                    "os"                    => $input["api_device_os"],
                    "date_added"            => Common::getCurrentDateTime(),
                    "date_last_connected"   => Common::getCurrentDateTime(),
                    "status"                => "0"
                )) ) {
                    $this->returnText = $Device->getReturnText();
                    return false;
                }
                $this->returnText = "Cihaz onayı gerek. Sistem yöneticinizle irtibata geçin.[2]";
                return false;
            }
        }
        /*
         * - add method, additional to the parent's add method we hash the password
         *
         * */
        public function add( $input ){
            // todo permission check
            /*if( !$this->adminFlag ){
                $this->returnText = "Yetkiniz yok.";
                return false;
            }*/
            // overwrite input[password] with hashed version
            $hash = password_hash( $input["password"], PASSWORD_BCRYPT, $this->passwordHashOptions );
            $input["password"] = $hash;
            if( !parent::add( $input ) ) return false;
            return true;
        }
    }