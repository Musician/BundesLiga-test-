<?php
class Team extends Object
{
	public function __construct($id=null, $key=MEMBERS_AUTHENTICATE_BY, $table="teams")
	{
		$this->type = "team";
		$this->suffix = "team";
		$this->table = $table;
		$this->$key = $id;
		$this->auth_field = $key;
		parent::__construct($id, $key, $table);
	}
	
}