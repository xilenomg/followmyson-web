<?php
 class UserLocationDAO extends DatabaseAccessObject{
 	
 	public $table_name = "UserLocation";
 	public $entity_name = "UserLocation";
 	
 	function UserLocationDAO(){
 		parent::__construct();
 	}
 	
 	function getLastByUser($user_id){
 		$query = 'SELECT * FROM '.$this->table_name.' WHERE user_id = "'.$user_id.'" LIMIT 1';
 		$exec = $this->QExec($query);
		$obj = mysql_fetch_object($exec, $this->entity_name);
		return $obj;
 	}
 	
 	function deleteLocationsByUser($user_id){
 		$query = 'DELETE FROM '.$this->table_name.' WHERE user_id = "'.$user_id.'"';
 		return $this->QExec($query);
 	}

 	
 }
?>
