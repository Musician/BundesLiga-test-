<?php
class Match extends Object
{
	public function __construct($id=null, $key="MatchID", $table="matches")
	{
		$this->type = "match";
		$this->suffix = "match";
		$this->table = $table;
		parent::__construct($id, $key, $table);
	}
	
	public function create($match)
	{
		include_once(CLASSES . "Team.class.php");
		include_once(CLASSES . "Player.class.php");
		include_once(CLASSES . "Location.class.php");
		include_once(CLASSES . "Group.class.php");
		include_once(CLASSES . "Goal.class.php");
		
		// Set (insert if missing) Location ID
		if ($match->Location->LocationID)
		{
			$location = new Location($match->Location->LocationID);
			if ( empty($location->id) )
				$match->LocationID = $location->create($match->Location);
			else 
				$match->LocationID = $location->id;
		}
		
		// Set (insert if missing) Group ID
		if ($match->Group->GroupID)
		{
			$group = new Group($match->Group->GroupID);
			if ( empty($group->id) )
				$match->GroupID = $group->create($match->Group);
			else
				$match->GroupID = $group->id;
		}
		
		// Set (insert if missing) Teams
		if ($match->Team1->TeamId)
		{
			$team1 = new Team($match->Team1->TeamId);
			if ( empty($team1->id) )
			{
				$team1->create($match->Team1);
				$match->Team1ID = $match->Team1->TeamId;
			}
			else
				$match->Team1ID = $team1->TeamId;
		}		
		
		if ($match->Team2->TeamId)
		{
			$team2 = new Team($match->Team2->TeamId);
			if ( empty($team2->id) )
			{
				$team2->create($match->Team2);
				$match->Team2ID = $match->Team2->TeamId;
			}
			else
				$match->Team2ID = $team2->TeamId;
		}
		
		// Set (insert if missing) Goals
		if (count($match->Goals))
		{
			foreach ($match->Goals as $goal)
			{
				
				$g = new Goal($goal->GoalID);
				$g->MatchID = $match->MatchID;
				if ( empty($g->id) )
					$g->create($goal);
				
			}
		}
		
		
		parent::create($match);
	}
	
	public function getUpcommingEvents()
	{
		global $conn;
		
		$arr = array();
		$all = $conn->GetAll("
			SELECT m.`MatchID`, m.`MatchDateTime`, t1.`TeamName` AS Team1, t2.`TeamName` AS Team2, t1.`TeamIconUrl` AS Team1URL, t2.`TeamIconUrl` AS Team2URL, l.`LocationCity`, l.`LocationStadium` FROM matches m
			LEFT JOIN teams t1 ON m.`Team1ID` = t1.`TeamId` 
			LEFT JOIN teams t2 ON m.`Team2ID` = t2.`TeamId` 
			LEFT JOIN locations l ON m.`LocationID` = l.`LocationID` 
			
			WHERE m.MatchDateTime > NOW() AND t1.`TeamName` IS NOT NULL AND t2.`TeamName` IS NOT NULL AND l.LocationCity IS NOT NULL				
		");
		
		foreach ($all as $a)
			$arr[$this->suffix . "_" . $a['MatchID']] = $a;
		
		return $arr;
		
	}
	
}