<?php 
include("config.php");
include(CLASSES . "Service.class.php");

$service = new Service();

if (!empty($_POST['search']))
	$result = $service->search($_POST['search']);

else 
	$result = json_encode(array("Error:" => "Service error"));
	

	
print $result;	
?>