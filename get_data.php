<PRE>
<?php
include("config.php");
include(CLASSES . "Match.class.php");
include(CLASSES . "curl.class.php");
$conn->debug=true;

$match = new Match();
$curl = new CURL();

$data = $curl->get("https://www.openligadb.de/api/getmatchdata/bl1/2016");
$data = json_decode($data);

foreach ($data as $match)
{
	// Check if we have data for the match
	$temp_match = new Match($match->MatchID);
	// If we do not have data for this match
	if (empty($temp_match->id))
	{
		// We create one. 
		$temp_match->create($match);
	}
		
}



?>
</PRE>