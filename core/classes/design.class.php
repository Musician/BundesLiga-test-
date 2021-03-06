<?php 
class Design
{
	public function __construct()
	{
		global $conn;
		$root = array(); # XML root element: will pack every xml entity before parsing the XSL templates
		include("array2xml.class.php");
		$array2xml = new assoc_array2xml();
		
		// Language selector
		(isset($_GET['a']) and $_GET['a'] != '') ? $action = $_GET['a'] : $action = "index";  
		if (isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
		(isset($_SESSION['lang'])) ? $lang = $_SESSION['lang'] : $lang = "bg";
		//$root['activelang'] = $lang;
		//$root['action'] = $action;
		
		if (!empty($member) AND method_exists($member, $action))
			$root['data'] = $member->$action(); 
		
		include_once CLASSES . 'Match.class.php';
		$match = new Match();
		$root['upcomming_events'] = $match->getUpcommingEvents();
		$root['season_matches'] = $match->getSeasonMatches();
		

		# # # # # # # # # # # # # # # # #
		// Load language translations and store them into $root['lang']
		$xml_file = XMLS . "lang/" . $lang . "/" . $action . '.xml';
		if (is_file($xml_file))
			$tmp = simplexml_load_file($xml_file);
		if ($tmp)
		 foreach ($tmp as $k=>$v)
			$root['lang'][$k]=$v;
			
		$xml_file = XMLS . "lang/" . $lang . "/default.xml";
		$tmp = simplexml_load_file($xml_file);
		foreach ($tmp as $k=>$v)
			$root['lang'][$k]=$v;

		// Convert data stored into $root in XML
		$this->xml=$array2xml->array2xml($root);
		
		// Combine XML and XSL and show the result. 
		$xsl_file = XSLS . $action . '.xsl';
		if (is_file($xsl_file)) $this->xsl_file = $xsl_file;
		if ($this->xml AND $this->xsl_file) $this->_show();
		else die("No associated templates. Exiting...");
		if (isset($_GET['view']) AND $_GET['view'] == "xml") echo $this->xml;
		if (isset($_GET['debug']) AND $_GET['debug']) { echo "<PRE>"; print_r($root); echo "</PRE>"; }
	}

	private function _show()
	{
		# LOAD XML FILE
		$xml = new DOMDocument();
		$xml->loadXML( $this->xml ); 

		# START XSLT
		$xslt = new XSLTProcessor();
		$xsl = new DOMDocument();
		$xsl->load( $this->xsl_file, LIBXML_NOCDATA);

		$xslt->registerPHPFunctions();
		
		$xslt->importStylesheet( $xsl );
		
		# SHOW
		echo $xslt->transformToXML( $xml ); 		
	}
	
	
	// TODO:
	// public function __autoload($class) 
	// {
	//		if (is_file(CLASSES . $class . "class.php") )
	//		{
	//			require_once(CLASSES . $class . "class.php");		
	//		}
	//		else if (is_file(CLASSES . ucfirst($class) . "class.php"))
	//		{
	//			require_once(CLASSES . ucfirst($class) . "class.php")
	//		}
	//		else
	//		{
	//			throw new Exception("Cann`t load class: $class");
	//		}
	// }
	
	
	// public function __get($key) {}
	// public function __set($key, $value) {}
}

?>