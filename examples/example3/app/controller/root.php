<?php
class root extends controller{
	public function index(){
		$this->load_view( "main_view" );
	}
}