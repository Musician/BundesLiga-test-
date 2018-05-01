<?php
class Team extends Object
{
	public function __construct($id=null, $key="TeamID", $table="teams")
	{
		$this->type = "team";
		$this->suffix = "team";
		$this->table = $table;
		parent::__construct($id, $key, $table);
	}
	
}