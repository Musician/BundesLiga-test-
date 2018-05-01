<?php
class Player extends Object
{
	public function __construct($id=null, $key="id", $table="players")
	{
		$this->type = "player";
		$this->suffix = "player";
		$this->table = $table;
		parent::__construct($id, $key, $table);
	}
	
}