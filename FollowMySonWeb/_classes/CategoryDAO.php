<?php
 class CategoryDAO extends DatabaseAccessObject{
 	
 	public $table_name = "Category";
 	public $entity_name = "Category";
 	
 	function CategoryDAO(){
 		parent::__construct();
 	}
 	
 	function getAllToMenu(){
 		$query = 'SELECT * FROM ' . $this->table_name . ' ORDER BY category_name ASC';
 		$exec = $this->QExec($query);
 		$categories = array();
 		while ( $category = mysql_fetch_object($exec, $this->entity_name)){
 			$categories[] = $category;
 		}
 		return $categories;
 	}
 	
 }
?>
