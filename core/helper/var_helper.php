<?php
if( !function_exists("value_or_blank") ){
	function value_or_blank( $var = null ){
		return isset( $var ) ? $var : "";
	}
	
}