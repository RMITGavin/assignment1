<?php
	//get 
	$wineName=$_GET['wineName'];
	$wineryName= $_GET['wineryName'];
	$minStockNo=$_GET['minStockNo'];
	$minOrderedNo=$_GET['minOrderedNo'];
	
	$minCost=$_GET['minCost'];
	$maxCost=$_GET['maxCost'];
	echo $maxCost;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Search WineStore</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
 
 <body>  
	<h1 align="center"><strong><span class="auto-style2">WineStore Management</span></strong></h1>
	<h2 align="center"><strong><span class="auto-style2">Results you are looking for:</span></strong></h2>
</body>

</html>