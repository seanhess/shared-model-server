#!/usr/bin/php -q
<?php  

require_once("SharedServer.php");

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();   
                   
$args = $_SERVER['argv'];
$flags = array(); 

$mySocketServer = new SharedServer();  
$mySocketServer->start();
  
?>