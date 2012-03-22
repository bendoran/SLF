<?php 
if( !function_exists( 'json_output' ) ){
	function json_output( $object ){
		header("Content-Type: text/json");
		echo json_encode( $object );
	}
}

if( !function_exists( "xml_output" ) ){
	function xml_ouput( $xml ){
		header("Content-Type: text/xml" );
		echo $xml;			
	}
}	