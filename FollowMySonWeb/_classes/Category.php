<?php
 class Category extends DatabaseModel{
	public $category_id = null;
	public $category_name = null;
	public $show_on_header = false;
	public $parent_id = null;
	
	public $db_fields = array('category_id','category_name','show_on_header','parent_id');
 }
?>
