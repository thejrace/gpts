<?php

	

	class Common {
		// array sort ederken, hangi key onun icin tanimli
		protected static $array_key;	

		public function dateReverse( $date ){
			$tarih_parcala = explode( "-", $date );
			$tarih_tr_format = "";
			for( $i = count($tarih_parcala)-1; $i > -1; $i-- ){
				if( $i == count($tarih_parcala)-1 ){
					$tarih_tr_format .= $tarih_parcala[$i];
				} else {
					$tarih_tr_format .= "-" . $tarih_parcala[$i];
				}
			}
			return $tarih_tr_format;
		}

		public function dateTimeReverse( $datetime ){
			$parcala = explode( " ", $datetime );
			$tarih_tr_format = "";
			$date_parcala = explode( "-", $parcala[0] );
			for( $i = count($date_parcala)-1; $i > -1; $i-- ){
				if( $i == count($date_parcala)-1 ){
					$tarih_tr_format .= $date_parcala[$i];
				} else {
					$tarih_tr_format .= "-" . $date_parcala[$i];
				}
			}
			return $tarih_tr_format . " " . $parcala[1];
		}


		public function comma2Digit( $price ){
			$price_str = (string)$price;
			$exp = explode(".", $price_str );
			// tam sayi geldiyse noktasiz
			if( count($exp) == 1 ){	
				return (float)( $price_str );
			} 	
			return (float)($exp[0] . '.' . substr($exp[1], 0, 2));
		}

		// floatlarda noktadan sonraki 0lar gozukmuyor nasil koyarsan koy
		// o yuzden sonraki 00 burda str olarak koyuyoruz
		public function dotToComma( $price ){
			$str = (string)$price;
			if( !strpos( $str, "." ) ){
				return $str . ",00";
			} else{
				$exp = explode( ".", $str );
				if( strlen($exp[1]) == 1 ){
					$str = $exp[0] . "," . $exp[1] . "0";
				}
			}
			return str_replace( ".", ",", $str );
		}

		public static function getCurrentDateTime(){
			return date("Y-m-d") . " " . date("H:i:s");
		}

		public static function getCurrentDate(){
			return date("Y-m-d");
		}

		public function getCurrentMY(){
			return date("Y-m");
		}

		public function getCurrentY(){
			return date("Y");
		}

		public static function getIP(){
			if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    return $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    return $_SERVER['REMOTE_ADDR'];
			}
		}

		public static function getIPInt(){
			return ip2long( self::get_ip() );
		}

		public static function sefLink($string) {
			$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
			$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
			$string = strtolower(str_replace($find, $replace, $string));
			$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
			$string = trim(preg_replace('/\s+/', ' ', $string));
			$string = str_replace(' ', '-', $string);
			return $string;
		}

		// rastgele token olusturma, editor img isimlendirmesinde kullaniyorum,
		// güvenlik için kullanma aman sakın
		public static function generateRandomString( $length = 10 ){
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$chars_len = strlen($chars);
			$str = "";
			for( $i = 0; $i < $length; $i++ ){
				$str .= $chars[ rand(0, $chars_len - 1 ) ];
			}
			return $str;
		}

		public static function generateUniqueRandomString( $table, $col, $length ){
			$str = self::generate_random_string( $length );
			if( DB::getInstance()->query("SELECT * FROM ". $table . " WHERE ".$col." = ?", array( $str ) )->count() != 0 ){
				self::generate_unique_random_string( $table, $col, $lenth );
			}
			return $str;
		}

		public static function sef( $fonktmp ) {
		    $returnstr = "";
		    $turkcefrom = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
		    $turkceto   = array("G","U","S","I","O","C","g","u","s","i","o","c");
		    $fonktmp = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$fonktmp);
		    // Türkçe harfleri ingilizceye çevir
		    $fonktmp = preg_replace($turkcefrom,$turkceto,$fonktmp);
		    // Birden fazla olan boşlukları tek boşluk yap
		    $fonktmp = preg_replace("/ +/"," ",$fonktmp);
		    // Boşukları - işaretine çevir
		    $fonktmp = preg_replace("/ /","-",$fonktmp);
		    // Whitespace
		    $fonktmp = preg_replace("/\s/","",$fonktmp);
		    // Karekterleri küçült

		    // Başta ve sonda - işareti kaldıysa yoket
		    $fonktmp = preg_replace("/^-/","",$fonktmp);
		    $fonktmp = preg_replace("/-$/","",$fonktmp);
		    $returnstr = $fonktmp;
		    return $returnstr;
		}

		// stringleri alfabetik siralama
		// usort fonksiyonu
		public static function compareStrings($x, $y ){
			return strcasecmp( self::array_key_sef($x[self::$array_key]) , self::array_key_sef($y[self::$array_key]) );
		}

	}