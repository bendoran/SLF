<?php
/**
 * self PHP:	Stupidly Light php Framework
 *
 * LICENSE:	MIT License
 *
 * self PHP is an extra light php framework released under MIT License
 * You should have received a copy of the MIT License along with this program.
 * If not, see http://www.opensource.org/licenses/mit-license.php
 *
 *
 * @copyright  2011 Ben Doran
 * @author     Ben Doran - ben.doran@bdoran.co.uk
 * @license    http://www.opensource.org/licenses/mit-license.php
 * @version    1.0
 * @link       http://bdoran.co.uk/self-php
 */

class_alias("slf","slf_core");
class slf{
	//List of known Config Keys
	public static $CONFIG_DB = "configDB";
	public static $CONFIG_BASE_URL = "configBaseURL";
	public static $CONFIG_DEFAULT_CONTROLLER = "baseController";
	public static $CONFIG_APP_LOCATION = "appFolder";
	public static $CONFIG_CORE_LOCATION = "coreLocation";

	//The Framework instance
	private static $instance;

	//Global Config Array
	private $config;

	//Current Controller
	private $current_controller;

	static function get_instance(){
		if( !isset(self::$instance) ){
			$class = __CLASS__;
			self::$instance = new $class;
		}
		return self::$instance;
	}
	
	public function __construct(){
		//Load the Base Helpers
		include('helper/var_helper.php');
		include('helper/array_helper.php');
		include('helper/url_helper.php');
	}

	public function __clone(){
		trigger_error('Clone is not allowed.', E_ERROR);
	}

	public function boot(){
		//Create Default Settings
		if( !$this->get_config( self::$CONFIG_APP_LOCATION ) ){
			$this->set_config( self::$CONFIG_APP_LOCATION, "app" );
		}
		 
		if( !$this->get_config( self::$CONFIG_DEFAULT_CONTROLLER ) ){
			$this->set_config( self::$CONFIG_DEFAULT_CONTROLLER, "root" );
		}
		 
		if( !$this->get_config( self::$CONFIG_CORE_LOCATION ) ){
			$this->set_config( self::$CONFIG_CORE_LOCATION, "core" );
		}
		 
		if( !$this->get_config( self::$CONFIG_BASE_URL ) ){
			$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$urlexploded = explode("index.php", $url );
			$this->set_config( self::$CONFIG_BASE_URL,  "http://".$urlexploded[0] );
		}
		 
		//Init the AutoLoading Instance
		autoloader::init( $this->get_config( self::$CONFIG_APP_LOCATION ), $this->get_config( self::$CONFIG_CORE_LOCATION ) );

		//Init the Routing
		$this->init_routes();
	}

	public function set_config( $key, $params ){
		if( !isset($this->config) ){
			$this->config = array();
		}
		$this->config[ $key ] = is_array( $params ) ? array_to_object( $params ) : $params;
	}

	public function get_config( $key ){
		if( isset( $this->config ) ){
			if( array_key_exists($key, $this->config ) ){
				return $this->config[ $key ];
			}
		}
		return null;
	}

	private function init_routes( ){
		$segments = get_url_segments();

		if( $segments[0] != "" ){
			$controller = $path = $function = null;
			$base_path = $this->get_app_directory() . '/controller';

			foreach( $segments as $key=>$segment ){
				if( strstr( $segment, "?" ) ){
					$segmentSplit = explode( "?", $segment );
					process_get_vars( $segmentSplit[1] );
					$segment = $segmentSplit[0];
					$segments[$key] = $segmentSplit[0];
				}
				if( is_dir( $base_path . $path . '/' . $segment) ){
					$path .= '/' . $segment;
					continue;
				}else{
					array_splice( $segments, 0, $key );
					break;
				}
			}

			foreach( $segments as $key=>$segment ){
				if( is_file( $base_path . $path . '/' . $segment . '.php' ) ){
					$controller = $segment;
					array_splice($segments, 0, $key + 1 );
					break;
				}
			}

			if( isset( $segments[0] ) ){
				$function = $segments[0];
				array_splice($segments, 0, 1 );
			}

			$this->load_controller( $controller, $path, $function, $segments );
		}else{
			$this->load_controller();
		}
	}

	private function load_controller( $controller = null, $path = null, $function = null, $parameters = null ){
		$controller = $controller ? $controller : $this->get_default_controller();
		$function = $function ? $function : 'index';
		$path = $path ? $path : '';
		$file = $this->get_app_directory() . "/controller" . $path . "/" . $controller . ".php";
		
		if( !is_file( $file ) ){
			$this->current_controller = new controller();
			$this->load_404($controller, $function);
			exit();
		}
		
		include( $file );
		$this->current_controller = new $controller();
		if( $parameters ){
			call_user_func_array(array( $this->current_controller, $function), $parameters );
		}else{
			if( method_exists( $this->current_controller, $function ) ){
				$this->current_controller->$function();
			}else{
				$this->current_controller->index( $function );
				//call the params on the index function
				//$this->load_404($controller, $function);
			}
		}
	}
	
	private function load_404( $controller, $function ){
		if( is_file( $this->get_app_directory() . "/view/404_view.php" ) ){
			$this->current_controller->load_view( '404_view', array("error" => "Function $function in $controller not found") );
		}else{
			$this->current_controller->load_view( 'default_404_view', array("error" => "Function $function in $controller not found"), $this->get_core_directory() );
		}
	}

	public function load_helper( $helper ){
		if( file_exists( $this->get_core_directory().'/helper/'.$helper.'.php' ) ){
			include_once $this->get_core_directory().'/helper/'.$helper.'.php';
		}else{
			include_once $this->get_app_directory().'/helper/'.$helper.'.php';
		}
	}

	//Getter Functions
	public function get_app_directory(){
		return $this->get_config( self::$CONFIG_APP_LOCATION );
	}

	public function get_core_directory(){
		return $this->get_config( self::$CONFIG_CORE_LOCATION );
	}
	
	public function get_default_controller(){
		return $this->get_config( self::$CONFIG_DEFAULT_CONTROLLER );
	}
}

class autoloader {

	public static $instance;

	private $app_location;
	private $core_location;

	static function init( $app_location, $core_location  ){
		if( !isset( self::$instance ) ){
			self::$instance = new autoloader( $app_location, $core_location  );
		}
		return self::$instance;
	}

	public function __construct( $app_location, $core_location ){
		$this->app_location = $app_location;
		$this->core_location = $core_location;
		spl_autoload_register( array( $this, 'core' ) );
		spl_autoload_register( array( $this, 'lib' ) );
		spl_autoload_register( array( $this, 'model') );
		spl_autoload_register( array( $this, 'ext') );
	}

	public function core( $class ){
		set_include_path( get_include_path() . PATH_SEPARATOR . $this->core_location . '/' );
		spl_autoload_extensions('.php');
        spl_autoload( $class );
    }
    
    public function lib( $class ){
        set_include_path( get_include_path() . PATH_SEPARATOR . $this->core_location . '/lib/' );
        spl_autoload_extensions('.php');
        spl_autoload( $class );
    }

    public function model( $class ){
        set_include_path( get_include_path() . PATH_SEPARATOR . $this->app_location . '/model/' );
        spl_autoload_extensions( '.php' );
        spl_autoload( $class );
    }
    
    public function ext( $class ){
        set_include_path( get_include_path() . PATH_SEPARATOR . $this->app_location . '/ext/' );
        spl_autoload_extensions( '.php' );
        spl_autoload( $class );
    }
}