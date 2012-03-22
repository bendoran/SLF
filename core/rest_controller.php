<?php
class rest_controller extends controller{
	
	protected static $CODE_200 = "200";
	protected static $CODE_400 = "400";
	protected static $CODE_401 = "401";
	protected static $CODE_404 = "404";
	
	protected $resource;
	protected $method;
	protected $headers;
	
	public function index( $resource = null ){
		$this->resource = $resource;
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->headers = $this->getHeaders();
		
		switch( $this->method ){
			case "GET" : 
				$this->get( $resource );
				break;
			case "POST" : 
				$this->post();
				break;
			case "PUT" : 
				$this->put( $resource );
				break;
			case "DELETE" : 
				$this->delete( $resource );
				break;
		}
	}
	
	private function getHeaders() {
		if(function_exists('apache_request_headers')) {
			return apache_request_headers();
		}
		$headers = array();
		$keys = preg_grep('{^HTTP_}i', array_keys($_SERVER));
		foreach($keys as $val) {
			$key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($val, 5)))));
			$headers[$key] = $_SERVER[$val];
		}
		return $headers;
	}
	
	protected function get( $resource ){
	}
	
	protected function put( $resource ){
	}
	
	protected function delete( $resource ){
	}
	
	protected function post(){
	}
	
	protected function sendResponse( $code, $response = null ){
		switch( $code ){
			case self::$CODE_200:
				header('HTTP/1.1 200 OK', true, 200);
				json_output( $response );
				break;
			case self::$CODE_400:
				header('HTTP/1.1 400 Bad Request', true, 200);
				break;
			case self::$CODE_401:
				header('HTTP/1.1 401 Unauthorized', true, 200);
				break;
			case self::$CODE_404:
				header('HTTP/1.0 404 Not Found', true, 404);
				break;
		}
		exit();
	}
}