<?php
 class UserDAO extends DatabaseAccessObject{
 	
 	public $table_name = "User";
 	public $entity_name = "User";
 	
 	function UserDAO(){
 		parent::__construct();
 	}
 	
 }
?>
