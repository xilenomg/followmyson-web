<?
	class DatabaseConnection{
		private $mysql_connection = null;
		private $mysql_database = null;
		private static $databaseConnection = null;
		
		private function DatabaseConnection(){
			$this->mysql_connection = mysql_connect(MYSQL_LOCALHOST, MYSQL_USUARIO, MYSQL_SENHA) or die('Could not connect to the database');
			$this->mysql_database = mysql_select_db(MYSQL_BANCO) or die('Database does not exists');
			
			mysql_set_charset('utf8', $this->mysql_connection);
		}

		public static function singleton() {
			if (!isset(self::$databaseConnection)) {
				$c = __CLASS__;
				self::$databaseConnection = new $c;
			}
		
			return self::$databaseConnection;
		}
		
		function getMysqlConnection() {
			return $this->mysql_connection;
		}
		
		public function __clone() {
			trigger_error('Clone is not allowed.', E_USER_ERROR);
		}
		
	}
?>