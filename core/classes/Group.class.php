<?php
class Group extends Object
{
	public function __construct($id=null, $key="GroupID", $table="groups")
	{
		$this->type = "group";
		$this->suffix = "group";
		$this->table = $table;
		parent::__construct($id, $key, $table);
	}
	
}