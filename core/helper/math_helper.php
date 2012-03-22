<?php 
if( !function_exists( 'microtime_float' ) ){
	function microtime_float(){
    	list($usec, $sec) = explode(" ", microtime());
    	return ((float)$usec + (float)$sec);
	}
}