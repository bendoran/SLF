<?php
class root extends controller{
	function index(){
		echo "<b>Function:</b> " . __FUNCTION__ . "<br/>";
		echo "<b>Class:</b> " . get_class( $this ) . "<br/>";; 
		echo "<b>File:</b> " . __FILE__ . "<br/>";
	}
	
	function foo(){
		echo "<b>Function:</b> " . __FUNCTION__ . "<br/>";
		echo "<b>Class:</b> " . get_class( $this ) . "<br/>";; 
		echo "<b>File:</b> " . __FILE__ . "<br/>";
	}
	
	function foobar( $variable ){
		echo "<b>Function:</b> " . __FUNCTION__ . "<br/>";
		echo "<b>Class:</b> " . get_class( $this ) . "<br/>";; 
		echo "<b>File:</b> " . __FILE__ . "<br/>";
		echo "<b>Variable:</b> $variable <br/>";
	}
}