<?php
class Match extends Object
{
	public function __construct($id=null, $key="MatchID", $table="matches")
	{
		$this->type = "matches";
		$this->suffix = "matches";
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
				$match->Team1ID = $team1->create($match->Team1);
				else
					$match->Team1ID = $team1->id;
		}		
		
		if ($match->Team2->TeamId)
		{
			$team2 = new Team($match->Team2->TeamId);
			if ( empty($team2->id) )
				$match->Team2ID = $team2->create($match->Team2);
				else
					$match->Team2ID = $team2->id;
		}
		
		// Set (insert if missing) Teams
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
	
}