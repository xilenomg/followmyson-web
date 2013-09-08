<? 
class SessionManager{
	
	private $time = 0;
	private $expired_time = 0;
	
	public function SessionManager(){
		//(60 sec * 60 min * 24 hours * 30 days).
		$this->time = SESSION_TIME;
		$this->expired_time = SESSION_EXPIRED_TIME;
	}
	
	public function createCookies($user){
		setcookie("uid", $user->user_id, $this->time, SESSION_PATH);
		setcookie("name", $user->user_name, $this->time, SESSION_PATH);
		setcookie("email", $user->user_email, $this->time, SESSION_PATH);
		setcookie("checkup", Checkup::criar(array($user->user_id,$user->user_name,$user->user_email)), $this->time, SESSION_PATH);
	}
	
	public function isLoggedIn($shouldLogout = true){
		if ( isset($_COOKIE["checkup"],$_COOKIE["uid"],$_COOKIE["name"],$_COOKIE["email"]) 
				&& Checkup::validar(array($_COOKIE["uid"],$_COOKIE["name"],$_COOKIE["email"]), $_COOKIE["checkup"])) {
			$userDAO = new UserDAO();
			$userDAO->get($_COOKIE['uid']);
			return true;			
		}	
		if ( $shouldLogout ){
			$this->logout();
		}
		return false;
	}
	
	public function isAdmin(){
		if ( $this-> isLoggedIn(false) ){
			if ( $_COOKIE['uid'] == 3 ||  $_COOKIE['uid'] == 5 ){
				return true;
			}
		}
		return false;
	}
	
	public function logout(){
		setcookie("uid", "", $this->expired_time);
		setcookie("name", "", $this->expired_time);
		setcookie("email", "", $this->expired_time);
		setcookie("checkup", "", $this->expired_time);
	}
}
?>