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
		//Run the query on the winestore
		if (!($result = @ mysql_query ($query, $connection))) 
		{
			showerror();
		}
		// Find out how many rows are found
		$rowsFound = @ mysql_num_rows($result);
		// If has no result
		if($rowsFound=0)
		{
			echo "<h3>No records match your search criteria</h3>";
		}
		// Else if the query returns results
		if($rowsFound>0)
		{
			echo "<h4>$rowsFound records found matching your criteria</h4><br/>";
			
			 // start a <table>.
			print "\n<table>\n<tr>" .
			"\n\t<th>Wine Name</th>" .
			"\n\t<th>Grape Varieties</th>" .
			"\n\t<th>Year</th>" .
			"\n\t<th>Winery</th>" .
			"\n\t<th>Region</th>" .
			"\n\t<th>Cost</th>" .
			"\n\t<th>Number of Bottles</th>" .
			"\n\t<th>Total Stock Sold</th>" .
			"\n\t<th>Total Sales Revenue</th>\n</tr>";

      // Get each of the query rows
      while ($row = @ mysql_fetch_array($result)) {
        
        print "\n<tr>\n\t<td>{$row["wine_name"]}</td>" .
            "\n\t<td>{$row["variety"]}</td>" .
            "\n\t<td>{$row["year"]}</td>" .
            "\n\t<td>{$row["winery_name"]}</td>" .
			"\n\t<td>{$row["region_name"]}</td>" .
			"\n\t<td>{$row["cost"]}</td>" .
			"\n\t<td>{$row["on_hand"]}</td>" .
			"\n\t<td>{$row["winery_name"]}</td>" .
            "\n\t<td>{$row["region_name"]}</td>\n</tr>";
      } 
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
	$query = "SELECT wine_name, variety, year, winery_name, region_name, cost, 
	FROM winery, region, wine, grape_variety, inventory, items
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