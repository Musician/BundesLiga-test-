<?php
// Main class holding all methods for mostly used sub-objects

class Object
{
	// cRud
	// Initialize object in ORM style. 
	public function __construct($id=0, $key="id", $table=null)
	{
        global $conn;
		//$conn->debug = true;
		if ($table) $this->table = $table;
        if ($result = $conn->Execute("SELECT * FROM $this->table WHERE id = -1"))
    	   	$obj_vars = $result->FetchObj();
        $empty_vars = $obj_vars;

        if (is_array($obj_vars) OR is_object($obj_vars))
        	$continue = 1;
        else
        	$continue = 0;

        if ($continue)
			if (array_key_exists($key, $obj_vars))
	        {
	            $result = $conn->GetAll("SELECT * from $this->table where $key='$id'");
	            if (isset($result[0]) AND is_array($result[0]))
	             foreach ($result[0] as $property_name=>$value)
	                $this->$property_name = $value;
	        }
        if ($continue)
			if ((!isset($this->id)) or ($this->id==''))
	            foreach ($empty_vars as $property_name=>$value)
	                $this->$property_name = '';
	}

	// Crud
	// Insert the object into database
	// Usage:
	// $member = new Member();
	// $member->create($_POST); -> will insert all matching data from $_POST into the new user object and from there - in database. 
	// ($_POST['something'] becomes $member->something and inserts into `members`.something column into database.  
 	public function create($properties)
    {
        global $conn;
        //$conn->debug = true;
		if (is_object($properties))
		{
			foreach ($properties as $k=>$v)
				$p[$k] = $v;
			unset($properties);
			$properties = $p;
		}

        $properties["date_registered"] = date("Y-m-d H:i:s");
        if (isset($this->type) AND $this->type == "member" )
        {
        	if (!$properties['password']) $properties['password'] = $this->gen_pwd();
			if (isset($properties['fullname'])) list($this->fname, $this->lname) = split(" ", $properties['fullname']);
			$this->hash_code = substr(md5($properties['mail'] . localtime() ), 0, 15);

			// Auto-login after registration
			//$_SESSION['username'] 		= $properties['mail'];
			//$_SESSION['password'] 	= md5($properties['password']);
        }



        $result = $conn->Execute("SELECT * FROM $this->table WHERE id = -1");
        $obj_vars = $result->FetchObj();
        $insertSQL = $conn->GetInsertSQL($result, get_object_vars($this));
        $conn->Execute($insertSQL);
        if (! $this->id) {$this->id = $conn->Insert_ID();}
        $this->update($properties);
        if (! $conn->ErrorMsg()) return $this->id;
        else return 0;
    }

    // crUd
    // Update object in database.
    // Possible ussage:
    // $member = new Member($id);
    // $member->something = "something-new";
    // $member->update();
	public function update($properties,$save_it=1)
    {
		if (is_object($properties))
		{
			foreach ($properties as $k=>$v)
				$p[$k] = $v;
			unset($properties);
			$properties = $p;
		}

    	foreach($properties as $property=>$value)
            if (isset($this->$property) AND $this->$property != $value and $value !='')
                $this->$property = $value;
        if ($save_it) $this->save();
    }

    // Alias to update 
	public function save()
	{
        global $conn;
        $result = $conn->Execute("SELECT * FROM $this->table  WHERE id = '$this->id'");
        $updateSQL = $conn->GetUpdateSQL($result, get_object_vars($this));
        if ($updateSQL) $conn->Execute($updateSQL);
	}
	
	// cruD
	// Sets `objecttable`.deleted = 1 into database. Not actual delete, just marking as deleted for later filter
	public function del()
	{
		$this->deleted = 1;
		$this->save();
	}

	
	// CURRENT STATUS - EXPERIMENTAL
	public function get_all($format = "raw")
	{
		global $conn;
		$all = $conn->GetAll("SELECT * FROM $this->table WHERE `deleted`=0");
		foreach ($all as $a)
		$arr[$this->suffix . $a['id']] = $a;
		return $this->data_format($arr, $format);
	}

	public function get_all_s($field, $match, $eq = "=", $format = "raw")
	{
		global $conn;
		if ($eq == "LIKE") $match = "%".$match."%";
		$all = $conn->GetAll("SELECT * FROM $this->table WHERE `".$field."` ".$eq." '".$match."' AND `deleted` = 0");
		foreach ($all as $a)
		$arr[$this->suffix . $a['id']] = $a;
		return $this->data_format($arr, $format);
	}

	public function get_one($id, $format = "raw")
	{
		global $conn;
		return $this->data_format($conn->GetAll("SELECT * FROM $this->table WHERE `id`='$id'"), $format);
	}

	public function data_format($data, $format = "raw")
	{
		if ($format == "raw") return $data;
		else if ($format == json) return json_encode($data);
		else if ($format == "xml")
		{
			include("array2xml.class.php");
			$array2xml = new assoc_array2xml();
			$ret=$array2xml->array2xml($data);
			return $ret;
		}	
	}

}
?>