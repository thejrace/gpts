<?php
    /* Gitaş - Obarey Inc. 2018 */

    /* GPApiTrigger - adds, removes, makes seen api triggers
     *    When clients make a change that requires others to update
     * their program, we add a ApiTrigger flag to the database.
     *    This flag contains information about the change which clients program
     * use it to figure out which type of request it should make.
     *
     *    This system's benefit is that, clients don't have to refresh-update their
     * program's data regulary to keep them updated using "infinite inner download threads".
     * Program consists a lot of things to check if there's a change or not. Which will cause a
     * lot of load on the server.
     *    With this way, only one "infinite thread" will check this ApiTriggers and then triggers requests.
     *
     *
     *  dependencies:
     *		- GPDataCommon.php
     *
     */
    class GPApiTrigger extends GPDataCommon {

        public function __construct( $val = null ){
            parent::__construct( DBT_GPAPITRIGGERS, array( "id" ), $val );



        }


    }