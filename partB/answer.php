<?php
	require 'db.php';
	function showerror() 
	{
		die("Error " . mysql_errno() . " : " . mysql_error());
	}

	function showWineList($query)
	{
		// Connect to the MySQL server
		if (!($connection = @ mysql_connect(DB_HOST, DB_USER, DB_PW))) 
		{
			die("Could not connect");
		}
		//Open the database connection
		if (!mysql_select_db(DB_NAME, $connection)) 
		{
			showerror();
		}
		//Run the query on the winestore through the connection get variety
		$result = mysql_query($query, $connection);
		//populate drop-down list
		while ($row = mysql_fetch_row($result)) 
		{
			echo "\n".'<option value ="' .$row[0].'">'.$row[0]."</option>";
		}	
		mysql_close($connection); 
	}
	//get data from url 
	$wineName=$_GET['wineName'];
	$wineryName= $_GET['wineryName'];
	$minStockNo=$_GET['minStockNo'];
	$minOrderedNo=$_GET['minOrderedNo'];
	$startYear=$_GET['startYear'];
	$endYear=$_GET['endYear'];
	$minCost=$_GET['minCost'];
	$maxCost=$_GET['maxCost'];
	
	//start query
	$query = "SELECT wine_id, wine_name, description, year, winery_name
	FROM winery, region, wine
	WHERE winery.region_id = region.region_id
	AND wine.winery_id = winery.winery_id";
	
	


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