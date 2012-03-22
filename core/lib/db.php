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
class db{
	private $db;

	public function init( $dbhost, $username, $password, $database ){
		try{
			$this->db = new PDO("mysql:host=$dbhost;dbname=$database", $username, $password );
		} catch(PDOException $e) {
		    echo "Error connecting to database: " . $e->getMessage();
		}
	}
	
	public function query( $query, $params = null ){
		return $this->bind_query($query, $params);
	}
	
	public function __destruct(){
		if( isset($this->dbqli) ){
			$this->db->close();
		}
	}
	
	private function bind_query( $query, $params ){
		$stmt = $this->db->prepare( $query );
		if( $stmt->execute( $params ) ){
			$results = array();
			while( $object = $stmt->fetchObject() ){
				$results[] = $object;
			}
			return new slf_db_result( $results );
		}else{
			$errorInfo = $stmt->errorInfo();
			echo "PDO Error: " . $errorInfo[2] . ", Code: " . $errorInfo[0];
		}
	}
}

class slf_db_result{
	private $results;
	public function __construct( $results ){
		$this->results = $results;
	}
	
	public function row( $key ){
		return $this->results ? $this->results[$key] : false;
	}
	
	public function num_rows(){
		return $this->results ? count( $this->results ) : false;
	}
	
	public function results(){
		return $this->results ? $this->results : false;
	}
}