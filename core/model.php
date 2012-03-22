<?php
/**
 *
 * LICENSE:	MIT License
 *
 * SLF PHP is an php micro-framework released under MIT License
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

// ------------------------------------------------------------------------

class model extends base{

	/**
	 * Overriden __get Magic Method loads the DB library, when a request for $this->db is made.
	 * This method is used to prevent the DB library being loaded all the time, when not needed, for example 
	 * if a model is connecting with outside services.
	 *  
	 * @param String $key
	 */
	public function __get( $key ){
		if( $key == "db" ){
			if( !isset( $this->db ) ){
				$this->load_library( "db" );
				$params = $this->get_core()->get_config( slf::$CONFIG_DB );
				$this->db->init( $params->server, $params->username, $params->password, $params->database );
			}
		}
		return $this->$key;
	}
	
}