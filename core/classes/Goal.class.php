<?php
class Goal extends Object
{
	public function __construct($id=null, $key="GoalID", $table="goals")
	{
		$this->type = "goal";
		$this->suffix = "goal";
		$this->table = $table;
		parent::__construct($id, $key, $table);
	}
	
	public function create($goal)
	{
		// Set (insert if missing) Group ID
		if ($goal->GoalGetterID)
		{
			$player = new Player($goal->GoalGetterID);
			if ( empty($player->id) )
				$player->create($goal);
		}
		
		
		parent::create($goal);
		
		
		
	}
}