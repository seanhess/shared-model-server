#!/usr/bin/php -q
<?php  

require_once('light/PolicyServer.php');

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();   

$args = $_SERVER['argv'];

if (empty($args[1]))
{
	echo "\nUsage: policy.php HOST\n";
	exit();
}

$host = $args[1];
                   
$mySocketServer = new PolicyServer($host);  
$mySocketServer->start();
  
?>