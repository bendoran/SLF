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
class controller extends base{

	public function index(){
	}
	
	public function load_view( $view, $params = null, $directory_override = null ){
		$core = $this->get_core();
		if( isset($params) ){
			foreach( $params as $key=>$param ){
				${$key} = $param;
			}
		}
		if( $directory_override ){
			$file = $directory_override . "/view/" . $view . ".php";
		}else{
			$file = $core->get_app_directory() . "/view/" . $view . ".php";
		}
		if( !is_file( $file ) ){
			throw new slf_exception( catnap_exception::$VIEW_NOT_FOUND, "View $file not found" );
		}else{
			include( $file );
		}
	}
	
	protected function load_model( $model ){
		$this->$model = new $model();
	}
	
	protected function get_post(){
		if( count( $_POST ) > 0 ){
			return array_to_object( $_POST );
		}else{
			return null;
		}
	}
	
	protected function get_get(){
		if( count( $_GET ) > 0 ){
			return array_to_object( $_GET );
		}else{
			return null;
		}
	}
}