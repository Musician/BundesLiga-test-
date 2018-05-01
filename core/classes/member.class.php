<?php
class Member extends Object
{
	public function __construct($id=null, $key=MEMBERS_AUTHENTICATE_BY, $table="members")
	{
		$this->type = "member";
		$this->suffix = "member";
		$this->table = $table;
		$this->$key = $id;
		$this->auth_field = $key;
		$this->Object($id, $key, $table);
	}

	public function login($username, $password)
	{
		global $conn;
		//$conn->debug=true;
			if (!$username OR !$password ) return 0;
			else if ( $member_id = $conn->GetOne("SELECT `id` FROM ".$this->table." WHERE `$this->auth_field`='$username' AND `password`=?",  $password) )
			{
				$_SESSION['username'] = $username;
				$_SESSION['logged'] = 1;
				$_SESSION['password'] = ($_SESSION['password']) ? $_SESSION['password'] : md5($password);
				return $member_id;
			}
			else  
				return 0;
	}
	
	public function admin_login($username, $password)
	{
		global $conn;
		//$conn->debug=true;
			if (!$username OR !$password ) return 0;
			else if ( $member_id = $conn->GetOne("SELECT `id` FROM ".$this->table." WHERE `level`>1 AND `$this->auth_field`='$username' AND `password`=?",  $password) )
			{
				$_SESSION['username'] = $username;
				$_SESSION['logged'] = 1;
				$_SESSION['password'] = ($_SESSION['password']) ? $_SESSION['password'] : md5($password);
				return $member_id;
			}
			else  
				return 0;
	}
	
	public function logout()
	{
			$_SESSION['username'] = '';
			$_SESSION['password'] = '';
			$_SESSION['logged'] = '';
			header("Location: " . URL);
	}
	
#######################################################	
	
	function gen_pwd($length = 9, $mode = 3)
		// MODES:
		// 1 -> from 0 to 9 only
		// 2 -> mode 1 + A-Z
		// 3 -> mode 1 & mode 2 + a-z
		// 4 -> mode 1 & mode 2 & mode 3 + special chars
	{
		// Функция за генериране на пароли
		$chars =
		//    0   1   2   3   4   5   6   7   8   9
			"48, 49, 50, 51, 52, 53, 54, 55, 56, 57";
		if ($mode == 2 ) $chars .= 
		//    A   B   C   D   E   F   G   H   I   J   K   L   M   N   O   P   Q   R   S   T   U   V   W   X   Y   Z
			"65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90";
		if ($mode == 3)  $chars .=
 		//    a   b   c   d     e    f    g    h    i    j    k    l    m    n    o    p   q    r    s    t    u    v    w    x    y    z
			"97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122";
		if ($mode == 4)  $chars .= 
		// Special chars. For HIGH level security password
		//    !   #   $   %   &   *   +   -   ^  _
			"33, 35, 36, 37, 38, 42, 43, 45, 94, 95";

		$allowed_chars = explode(",", str_replace(" ", "", $chars));
		$pwd = '';
		while (strlen($pwd) != $length ) 
		{
			$rand = mt_rand(1, 130);
			if (in_array($rand, $allowed_chars))
				$pwd .= chr($rand);				
		}
		return $pwd;
	}

}	
?>