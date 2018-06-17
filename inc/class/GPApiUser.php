<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPUser - API User class
    *
    *  dependencies:
    *		- GPDataCommon.php
    */

    class GPApiUser extends GPDataCommon {

        public function __construct( $val = null ){
            parent::__construct( DBT_APIUSERS, array( "id", "email", "nick" ), $val );
        }

    }