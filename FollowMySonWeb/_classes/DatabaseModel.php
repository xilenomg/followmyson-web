<?php 
class DatabaseModel{
	function DatabaseModel(){
		if ( !isset($this->db_fields) || sizeof($this->db_fields) < 1){
			die('DatabaseModel must has db_fields: <b>' . get_class($this) . '</b> model');
		}
	}
	
	function encodeObject(){
		foreach ($this as $key => $value) {
		    echo "$key => $value\n";
		}
	}
	
	function toJson(){
		$returnedArray = array();
		$issetV = isset($this->db_secure_fields);
		foreach ($this as $key => $value) {
			if ( $key != "db_fields" && $key != "db_secure_fields"){
				$returnedArray[$key] = $value;
			}
		}
		return $returnedArray;
	}
}

?>