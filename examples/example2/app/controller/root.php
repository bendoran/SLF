<?php
class root extends controller{
	
	public function __construct(){
		$this->load_model( "student_model" );
	}
	
	public function index(){
		$students = $this->student_model->get_students();
		
		$view_data = array(
			'students' => $students,
		);
		
		$this->load_view( 'home_view', $view_data );
	}
	
	public function addstudent(){
		$view_params = array(
			"submitted" => false
		);
		
		if( $post = $this->get_post() ){
			
			$student = array( 
				$post->first_name,
				$post->second_name,
				$post->gender,
				$post->year."-".$post->month."-".$post->day
			);
			
			if( $this->student_model->add_student( $student ) ){
				$view_params['submitted'] = true;
			}
		}
		
		$this->load_view( 'form_view', $view_params );
	}
}