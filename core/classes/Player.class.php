<?php
class Player extends Object
{
	public function __construct($id=null, $key="id", $table="players")
	{
		$this->type = "player";
		$this->suffix = "player";
		$this->table = $table;
		$this->$key = $id;
		$this->auth_field = $key;
		parent::__construct($id, $key, $table);
	}
	
}