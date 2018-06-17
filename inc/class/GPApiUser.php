<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPUser - API User class
    *
    *  dependencies:
    *		- GPDataCommon.php
    */

    class GPApiUser extends GPDataCommon {

        private $passwordHashOptions = array( 'cost' => 12 );

        public function __construct( $val = null ){
            parent::__construct( DBT_APIUSERS, array( "id", "email" ), $val );

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
                "date_added" => array(
                    "label" 		=> "Grup",
                    "validation" 	=> array( "req" => true )
                )
            );

        }

        /*
         * - add method, additional to the parent's add method we hash the password
         *
         * */
        public function add( $input ){
            // overwrite input[password] with hashed version
            $hash = password_hash( $input["password"], PASSWORD_BCRYPT, $this->passwordHashOptions );
            $input["password"] = $hash;
            parent::add( $input );
        }


    }