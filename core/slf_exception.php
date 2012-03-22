<?php
class slf_exception extends Exception{
	public static $CONTROLLER_NOT_FOUND = 0;
	public static $VIEW_NOT_FOUND = 1;
	public function __construct( $code, $custom_message = null ){
		switch( $code ){
			case self::$CONTROLLER_NOT_FOUND : 
				$message = __CLASS__." Exception: CONTROLLER NOT FOUND";
				break;
			case self::$VIEW_NOT_FOUND : 
				$message = __CLASS__." Exception: VIEW NOT FOUND";
				break;
			default : 
				$message = "Unknown Code";
		}
		if( $custom_message ){
			$message .= " CUSTOM MESSAGE[ $custom_message] ";
		}
		parent::__construct( $message, $code );
	}
}