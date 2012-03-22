<?php
class student_model extends model{
	public function get_students(){
		$sql = "SELECT * FROM students";
		if( $results = $this->db->query($sql) ){
			return $results->results();
		}else{
			return false;
		}
	}
	
	public function add_student( $params ){
		$sql = "INSERT INTO students (first_name, last_name, gender, dob, date_enrolled) VALUES (?, ?, ?, ?, NOW() )";
		if( $this->db->query( $sql, $params ) ){
			return true;
		}else{
			return false;
		}
	}
}