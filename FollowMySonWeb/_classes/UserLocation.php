<?php
class UserLocation extends DatabaseModel{
	public $userlocation_id = null;
	public $user_id = null;
	public $latitude = null;
	public $longitude = null;
	
	public $db_fields = array('userlocation_id','user_id','latitude','longitude');
}
?>
