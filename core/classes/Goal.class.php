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
	
}