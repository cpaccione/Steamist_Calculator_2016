<?php ob_start(); 
session_start(); ?><?php
if ($_GET["reset"] = "1") {
	$_SESSION['length']  = "";
	$_SESSION['height']  = "";
	$_SESSION['width']  = "";
	$_SESSION['materials']  = "";
	$_SESSION['numwalls']  = "";
	$_SESSION['ceiling']  = "";
	$_SESSION['skylight']  = "";
	$whereFrom = explode('/', $_GET["src"]);
	if($whereFrom[1] == "mysteamist2") {
		header("Location: /mysteamist2/calc.php");
	}else {
		header("Location: /residential-sizing-guide/");
		
	}
}