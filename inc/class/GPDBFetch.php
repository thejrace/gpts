<?php
    /* Gitaş - Obarey Inc. 2018 */

    /*  GPDBFetch
    *
    *
    *   - common db fetch table actions class */

    class GPDBFetch {
        public static function action( $table, $dbKeysToFetch, $settings, $whereClause = null ){;
            ( !empty( $dbKeysToFetch ) ) ? $star = implode(", ", $dbKeysToFetch ) : $star = "*";
            ( isset($settings["order_by"] ) ) ? $orderby = "ORDER BY " . implode(", ", $settings["order_by"] ) : $orderby = "";
            ( isset($settings["limit"]) ) ? $limit = "LIMIT ".$settings["start_index"]."," . $settings["limit"] : $limit = "";
            if( isset($whereClause) ){
                $q = DB::getInstance()->query("SELECT ".$star." FROM " . $table . " WHERE ". $whereClause["keys"] . " " . $orderby . " " . $limit, $whereClause["vals"] )->results();
                if( DB::getInstance()->error() ){
                    return array();
                } else {
                    return $q;
                }
            } else {
                $q = DB::getInstance()->query("SELECT ".$star." FROM " . $table . " " . $orderby . " " . $limit )->results();
                if( DB::getInstance()->error() ){
                    return array();
                } else {
                    return $q;
                }
            }
        }
        public static function search( $table, $dbKeysToFetch, $settings, $searchParams, $whereClause = null ){
            ( !empty( $dbKeysToFetch ) ) ? $star = implode(", ", $dbKeysToFetch ) : $star = "*";
            ( isset($settings["order_by"] ) ) ? $orderby = "ORDER BY " . implode(", ", $settings["order_by"] ) : $orderby = "";
            ( isset($settings["limit"]) ) ? $limit = "LIMIT ".$settings["start_index"]."," . $settings["limit"] : $limit = "";
            if( isset($whereClause) ){
                $q = DB::getInstance()->query("SELECT ".$star." FROM " . $table . " WHERE ("
                    .$searchParams["key"] . " LIKE ? || "
                    .$searchParams["key"] . " LIKE ? || "
                    .$searchParams["key"] . " LIKE ? ) && (".
                    $whereClause["keys"] . " ) " . $orderby . " " . $limit,
                        array_merge( array("%".$searchParams["keyword"], $searchParams["keyword"]."%", "%".$searchParams["keyword"]."%" ),
                                     $whereClause["vals"]
                        )
                )->results();
                if( DB::getInstance()->error() ){
                    return array();
                } else {
                    return $q;
                }
            } else {
                $q = DB::getInstance()->query("SELECT ".$star." FROM " . $table . " WHERE "
                    .$searchParams["key"] . " LIKE ? || "
                    .$searchParams["key"] . " LIKE ? || "
                    .$searchParams["key"] . " LIKE ? "
                    .$orderby . " " . $limit, array("%".$searchParams["keyword"], $searchParams["keyword"]."%", "%".$searchParams["keyword"]."%" ) )->results();
                if( DB::getInstance()->error() ){
                    return array();
                } else {
                    return $q;
                }
            }
        }
    }