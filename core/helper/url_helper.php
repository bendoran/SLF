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
if( !function_exists( "base_url" ) ){
	function base_url(){
		return slf::get_instance()->get_config( slf::$CONFIG_BASE_URL );
	}
}

if( !function_exists( "get_current_url" ) ){
	function get_current_url(){
		return "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}
}

if( !function_exists( "get_url_segments" ) ){
	function get_url_segments(){
		$url = get_current_url();
		$url = str_ireplace( base_url(), "", $url );
		$segments = explode("/", $url );
		return is_array( $segments ) ? $segments : array( $segments );
	}
}

if( !function_exists( "process_get_vars" ) ){
	function process_get_vars( $varString ){
		$vars = explode( "&", $varString );
		foreach( $vars as $var ){
			$varSplit = explode( "=", $var );
			$_GET[ $varSplit[0] ] = $varSplit[1];
		}
	}
}