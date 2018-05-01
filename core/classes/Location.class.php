<?php
class Location extends Object
{
	public function __construct($id=null, $key="LocationID", $table="locations")
	{
		$this->type = "loc";
		$this->suffix = "loc";
		$this->table = $table;
		parent::__construct($id, $key, $table);
	}
	
}