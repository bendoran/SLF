<?php
interface rest_model{
	public function get_resource( $id );
	public function get_resources( );
	public function create_resource( $params );
	public function update_resource( $id, $params );
	public function delete_resource( $id );
}