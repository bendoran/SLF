<?php
class student extends rest_controller{
	
	protected function get( $resource ){
		$this->load_model( "student_model" );
		$this->load_helper( "output_helper" );
		if( $resource ){
			$response = $this->student_model->get_student( $resource );
		}else{
			$response = $this->student_model->get_students();
		}
		if( !$response ){
			$this->sendResponse( self::$CODE_404 );
		}else{
			$this->sendResponse( self::$CODE_200, $response );
		}
	}
	
	protected function post(){
		$this->load_model( "student_model" );
		$post = $this->get_post();
		if( !$post ){
			$this->sendResponse( self::$CODE_400 );
		}
		
		$firstName = value_or_blank( $post->first_name );
		$secondName = value_or_blank( $post->second_name );
		$gender = value_or_blank( $post->gender );
		$dob = value_or_blank( $post->dob );
		
		if( $firstName && $secondName && $gender && $dob ){
			$response = $this->student_model->add_student( array( $firstName, $secondName, $gender, $dob ) );
			//TODO - Return the student
		}else{
			$this->sendResponse( self::$CODE_400 );
		}
		
	}
	
}