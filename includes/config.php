<?php 
session_start();
ob_start();

define("SITE_URL","http://ec2-13-234-239-82.ap-south-1.compute.amazonaws.com/");
define("SITE_PATH",dirname(__FILE__));
ini_set("log_errors", 1);
ini_set("error_log", "log/php-error.log");

?>