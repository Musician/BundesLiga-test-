<?php
setlocale(LC_ALL, 'bg_BG.utf8'); 
	
ini_set("memory_limit","256M");
ini_set("display_errors", 1);
//error_reporting(E_ERROR | E_WARNING);
session_start();


define('URL', 		'http://'. $_SERVER['SERVER_NAME'] .'/');	// Full URL of the site
define('PATH', 		dirname(__FILE__) . "/");					// GET and SET Full path to the site as present on the server

// Design
define('XMLS', 		PATH. 'xml/');
define('XSLS', 		PATH. 'xsl/');

// Core
define('CORE', PATH . "core/");
define('CLASSES', 	CORE . 'classes/');

// AdoDB (MySQL) Module
include(CORE . "adodb/adodb.inc.php");

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'bundesliga');

	$conn = NewADOConnection('mysqli');
	$conn->no_autoincrement = false;
	$conn->Connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$conn->SetFetchMode(ADODB_FETCH_ASSOC); 
	$conn->Execute("set names 'utf8'"); // UPDATE [TABLE] SET [FIELD]=CONVERT(CONVERT(CONVERT([FIELD] USING 'latin1') USING BINARY) USING 'utf8');
// AdoDB (MySQL) Module

// Load MAIN classes
include(CLASSES . "design.class.php"); 
include(CLASSES . "object.class.php");

// Mail settings, if system will send emails
define('SYSTEM_SENDER', "DEV");						// If email sending is omitted - add here the FROM sender
define('SYSTEM_EMAIL', "ivan@accedo.dk");			// If email sending is omitted - add here the from_mail sender
define('DEBUG_EMAIL', "ivan@accedo.dk");			// If email sending is omitted - add here the from_mail sender
define("HEADERS", "From: " . SYSTEM_SENDER . " <" . SYSTEM_EMAIL . ">\r\nReply-To: " . SYSTEM_EMAIL . "\r\nX-Mailer: www.aleksandrow.net - PHP Mailer v." . phpversion() . "\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8\r\nReturn-Receipt-To: ". DEBUG_EMAIL ."\r\nDisposition-Notification-To: ". DEBUG_EMAIL ."\r\nX-Scanned-by-Cloudmark: Yes\r\nX-Spam-Score: 0.000000\r\nBcc: " . DEBUG_EMAIL . "\r\n");

// DEBUGs	
if ($_SERVER['REMOTE_ADDR'] == "95.87.228.122") 
{	
	//echo "<PRE>";
	error_reporting(E_ALL);
	//$conn->debug=true;
	//print_r($_SESSION);
	//print_r($_SERVER);
	//print_r(get_defined_constants(true));
	//echo "</PRE>";
}	
// DEBUGs

// OTHERS
define("MEMBERS_AUTHENTICATE_BY", "email"); # Set here the name of the field used for member authentication. I.e. email (and password), username (and password). Field should exist in member`s table

// The very important and vital checks
// phpinfo() and die();
if (!extension_loaded('xsl') && !extension_loaded('xslt')) die("No XSL(T) Loaded!");

?>