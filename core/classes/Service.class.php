<?php 
class Service
{
	protected $return_format = "json";

	public function __construct()
	{
	}
	
	public function search($string)
	{
		if (strpos($string, ":"))
			list($control,$str) = explode(":", $string);
		else
			return $this->format_string($this->simpleSearch($string));
		switch ($control) {
			case "team":
			return $this->format_string($this->searchByTeam($str));
		    break;
		}

		
	}
	
	private function searchByTeam($string)
	{
		global $conn;
		$data = array();
		($_POST['season'] AND $_POST['season'] !="undefined" AND $_POST['season'] !="null") ? $additional_where = " AND YEAR(m.MatchDateTime) = '".$_POST['season']."' " : $additional_where = "";  
		
		$sql = "
			SELECT m.MatchDateTime, t1.`TeamName` AS team1name, t2.`TeamName` AS team2name FROM goals g
			LEFT JOIN matches m ON g.`MatchID` = m.`MatchID`
			LEFT JOIN locations l ON m.`LocationID`=l.`LocationID`
			LEFT JOIN teams t1 ON m.Team1ID=t1.id
			LEFT JOIN teams t2 ON m.Team2ID=t2.id
			WHERE (t1.`TeamName` LIKE '%$string%' OR t2.`TeamName` LIKE '%$string%') 	$additional_where
			GROUP BY m.MatchDateTime
		";

		$result = $conn->getAll($sql);
		foreach ($result as $r)
			$data[] = array_values($r);
		return $data;
	}
	
	private function simpleSearch($string)
	{
		echo "Trigger simple search";
	
	}
	
	
	private function format_string($string)
	{
		if ($this->return_format == "json")
			return json_encode($string);
		else if ($this->return_format == "xml")
		{
			include("array2xml.class.php");
			$array2xml = new assoc_array2xml();
			return $array2xml->array2xml($string);
		}
		else 
			return $string;
	}
	
	
}
?>