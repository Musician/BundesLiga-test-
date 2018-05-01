<?php
class Match extends Object
{
	public function __construct($id=null, $key=MEMBERS_AUTHENTICATE_BY, $table="matches")
	{
		$this->type = "matches";
		$this->suffix = "matches";
		$this->table = $table;
		$this->$key = $id;
		$this->auth_field = $key;
		$this->Object($id, $key, $table);
	}
	
}