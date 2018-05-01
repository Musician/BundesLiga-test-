<?php

class API extends Object
{

		public function __construct() {
			// Get caller`s IP
			$remote_ip = $_SERVER['REMOTE_ADDR'];
			// Get allowed IP`s list
			if ( is_file(PATH . 'ip_api_allowed_list.txt') ) 
				$ip_api_allowed_list = file(PATH . 'ip_api_allowed_list.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		
			// Allow only certain IPs
			if ( (!defined("ALLOW_API_CONNECT_FROM_EVERYONE") OR ALLOW_API_CONNECT_FROM_EVERYONE == 0)  AND !in_array($remote_ip, $ip_api_allowed_list ))
				die("[$remote_ip] is NOT allowed to use this service. Please, contact your developers.");

			// GO!
			else
			{
				if (!isset($_GET['a'])) 
					die("Error: Action should be specified by caller.");
				else
					$action = $_GET['a']; 
				
				(isset($_GET['f'])) ? $this->format = $_GET['f'] : $this->format = "json"; 

				// Load Custom API functions
				if ( is_file(MODULES . 'custom.api.class.php'))
				{
					include_once(MODULES . 'custom.api.class.php');
					$custom_api = new Custom_API();
				}

				if (method_exists($this, $action))
					$result = $this->$action();
				else if (method_exists($custom_api, $action))
					$result = $custom_api->$action();
				else 
					$result = array ("api_error_message" => "'$action' is not defined.");


				// Return result in required format
				switch ($this->format){
					case "json":
						echo json_encode($result);
					break;

					case "print_r":
						echo "<PRE>" . print_r($result, 1) . "</PRE>";
					break;

					case "xml":
						include_once(CLASSES."array2xml.class.php");
						$array2xml = new assoc_array2xml();
						echo $array2xml->array2xml($result);
					break;
				}
			}
		}


	// Here are defined the global API functions. If a function would be used ONLY for one client, you should define it in project/modules/custom.api.class.php


	// A test function
	public function member_exists()
	{
		include_once(CLASSES."member.class.php");
		$member = new member();
		($member->login($_GET['username'], $_GET['password'])) ? $member_exists = 1 : $member_exists = 0; 
	
		return array("member_exists" => $member_exists, "username" => $_GET['username'], "password" => $_GET['password']);
		
	}

}
?>