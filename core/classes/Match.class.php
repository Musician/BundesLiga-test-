<?php
class Match extends Object
{
	public function __construct($id=null, $key="id", $table="matches")
	{
		$this->type = "matches";
		$this->suffix = "matches";
		$this->table = $table;
		$this->$key = $id;
		$this->auth_field = $key;
		parent::__construct($id, $key, $table);
	}
	
}