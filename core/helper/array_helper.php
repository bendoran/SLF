<?php
/**
 * SLF PHP:	Stupidly Light php Framework
 *
 * LICENSE:	MIT License
 *
 * SLF PHP is an extra light php framework released under MIT License
 * You should have received a copy of the MIT License along with this program.  
 * If not, see http://www.opensource.org/licenses/mit-license.php
 * 
 *
 * @copyright  2011 Ben Doran
 * @author     Ben Doran - ben.doran@bdoran.co.uk
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @version    1.0
 * @link       http://bdoran.co.uk/slf-php
 */
if( !function_exists("array_to_object") ){
	function array_to_object( $array ){
		$object = new stdClass();
		foreach( $array as $key=>$element){
			$object->$key = is_array($element) ? array_to_object( $element ) : $element;				
		}
		return $object;
	}
}

if( !function_exists("object_to_array") ){
	function object_to_array( $object ){
		$array = array();
		foreach( $object as $key=>$element ){
			$array[$key] = is_object( $element ) ? object_to_array( $element ) : $element;
		}
		return $array;
	}
}