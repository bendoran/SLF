<?php
/**
 * SLF PHP:	Stupidly Light php Framework
 *
 * LICENSE:	MIT License
 *
 * SLF PHP is a php micro-framework released under MIT License
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
class base{
	public function get_core(){
		return slf::get_instance();
	}
	
	public function load_helper( $helper ){
		$this->get_core()->load_helper( $helper );
	}
	
	public function load_library( $library ){
		$this->$library = new $library();
	}
}