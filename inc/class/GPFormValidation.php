<?php
    /* Gitaş - Obarey Inc. 2018 */

	/* GPFormValidation - common form validation class with error outputs
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
			"Bu %%FIELD%% zaten kullanımda.",
			"%%FIELD%% sıfırdan farklı olmalıdır.",
			"%%FIELD%% pozitif numerik olmalıdır.",
			"%%FIELD%% numerik olmalıdır.",
			"%%FIELD%% çok kısa.",
			"%%FIELD%% çok uzun."
		);

		// success messages
		public static $SUCCESS_MESSAGE = "İşlem tamamlandı";

		// error message
		private $returnText, $errorIndex;

		// method used in error outputs
		public static function outErrorMessage( $type, $val = null ){
			if( isset($val) ) return str_replace( "%%FIELD%%", $val, self::$ERROR_MESSAGES[$type] );
			return self::$ERROR_MESSAGES[$type];
		}

		/*
		/* method for checking the input
		*	@methodName : validation method to run
		*	@input 		: input value
		*	@inputRule  : input rule ( eg. maxlen, minlen )
		*/
		public function check( $methodName, $input, $inputRule, $label ){
			$flag = call_user_func_array(array( $this, $methodName ), array( $input, $inputRule ) );
			if( !$flag ){
				$this->returnText = self::outErrorMessage( $this->errorIndex, $label );
			}
			return $flag;
		}

		protected function notZero( $value, $ruleValue  ){
			$this->errorIndex = 4;
			return !( $value <= 0 );
		}

		protected function req( $value, $ruleValue){
			$this->errorIndex = 0;
			$trim_value = trim($value);
			return !empty($trim_value);
		}

		protected function minlen( $value, $ruleValue){
			$this->errorIndex = 7;
			return mb_strlen($value) >= $ruleValue;
		}

		protected function maxlen( $value, $ruleValue){
			$this->errorIndex = 8;
			return mb_strlen($value) <= $ruleValue;
		}

		protected function numeric( $value, $ruleValue){
			$this->errorIndex = 6;
			return is_numeric($value) ? true : false;
		}

		protected function posnum( $value, $ruleValue){
			$this->errorIndex = 5;
			return is_numeric($value) && $value >= 0;
		}

		protected function email( $value, $ruleValue){
			$this->errorIndex = 1;
			return filter_var($value, FILTER_VALIDATE_EMAIL);
		}

		public function getErrorMessage(){
			return $this->returnText;
		}

	}