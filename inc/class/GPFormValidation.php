<?php
		
	/* GPFormValidation - common form validation class with error outputs
	*  Created by Obarey Inc. 06.06.2018
	*
	*  dependencies:
	*		- none
	*		
	*/
	class GPFormValidation {

		// error keys
		public static $ERROR_KEY_REQ = 0,
					  $ERROR_KEY_EMAIL = 1,
					  $ERROR_KEY_INVALID_COMMON = 2,
					  $ERROR_KEY_UNIQUE = 3;
		
		// error messages
		public static $ERROR_MESSAGES = array(
			"%%FIELD%% boş bırakılamaz.",
			"Lütfen geçerli bir eposta adresi giriniz.",
			"Lütfen geçerli bir %%FIELD%% değeri giriniz.",
			"Bu %%FIELD%% zaten kullanımda."
		);

		// success messages
		public static $SUCCESS_MESSAGE = "İşlem tamamlandı";;

		// method used in error outputs
		public static function outErrorMessage( $type, $val = null ){
			if( isset($val) ) return str_replace( "%%FIELD%%", $val, self::$ERROR_MESSAGES[$type] );
			return self::$ERROR_MESSAGES[$type]
		}

		/*
		/* method for checking the input
		*	@methodName : validation method to run
		*	@input 		: input value
		*	@inputRule  : input rule ( eg. maxlen, minlen )
		*/
		public function check( $methodName, $input, $inputRule ){
			return call_user_func_array(array( $this, $methodName ), array( $input, $inputRule ) );
		}

		protected function notZero( $value, $ruleValue  ){
			return !( $value <= 0 );
		}

		protected function req( $value, $ruleValue){
			$trim_value = trim($value);
			return !empty($trim_value);
		}

		protected function minlen( $value, $ruleValue){
			return mb_strlen($value) >= $ruleValue;
		}

		protected function maxlen( $value, $ruleValue){
			return mb_strlen($value) <= $ruleValue;
		}

		protected function numeric( $value, $ruleValue){
			return is_numeric($value) ? true : false;
		}

		protected function posnum( $value, $ruleValue){
			return is_numeric($value) && $value >= 0;
		}

		protected function email( $value, $ruleValue){
			return filter_var($value, FILTER_VALIDATE_EMAIL);
		}

	}