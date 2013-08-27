
<?php
	require_once ('db.php');
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
		if($rowsFound==0)
		{
			echo '<h2 align="center">No records match your search criteria.</h2>';
		}
		// Else if the query returns results
		if($rowsFound>0)
		{
			echo "<h3 align=\"center\">{$rowsFound} records found matching your criteria:</h3>";
			
			 // start a <table>.
			print "\n<table align='center'; border='1'>\n<tr>" .
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
			while ($row = @ mysql_fetch_array($result)) 
			{
        
				print "\n<tr>\n\t<td align='center'>{$row["wine_name"]}</td>" .
				"\n\t<td align='center'>{$row["variety"]}</td>" .
				"\n\t<td align='center'>{$row["year"]}</td>" .
				"\n\t<td align='center'>{$row["winery_name"]}</td>" .
				"\n\t<td align='center'>{$row["region_name"]}</td>" .
				"\n\t<td align='center'>\${$row["cost"]}</td>" .
				"\n\t<td align='center'>{$row["on_hand"]}</td>" .
				"\n\t<td align='center'>{$row["qty"]}</td>" .
				"\n\t<td align='center'>\${$row["revenue"]}</td>\n</tr>";
			}	 
		}
		
		mysql_close($connection); 
	}//end function
	
	// Get data from url 
	$wineName=$_GET['wineName'];
	$wineryName= $_GET['wineryName'];
	$minStockNo=$_GET['minStockNo'];
	$minOrderedNo=$_GET['minOrderedNo'];
	$startYear=$_GET['startYear'];
	$endYear=$_GET['endYear'];
	$minCost=$_GET['minCost'];
	$maxCost=$_GET['maxCost'];
	$regionName=$_GET['regionName'];
	$grapeVariety=$_GET['grapeVariety'];
	
	// Start query
	$query = "SELECT wine_name, variety, year, winery_name, region_name, cost, on_hand, qty, qty*price as revenue
	FROM winery, region, wine, grape_variety, inventory, items, wine_variety
	WHERE wine.wine_id = inventory.wine_id 
	AND wine.wine_id = items.wine_id 
	AND wine.wine_id = wine_variety.wine_id AND wine_variety.variety_id = grape_variety.variety_id 
	AND winery.region_id = region.region_id
	AND wine.winery_id = winery.winery_id";
	
	
	// Add user input to where clause base on users' input data
	
	//wineName
	if (!empty($wineName))
	{
		$query .= " AND wine_name LIKE '%{$wineName}%'";
	}
	//wineryName
	if (!empty($wineryName))
	{
		$query .= " AND winery_name LIKE '%{$wineryName}%'";
	}
	//regionName
	if (!empty($regionName) && $regionName != "All")
	{
		$query .= " AND region_name = '{$regionName}'";
	}
	//grape variety
	if (!empty($grapeVariety))
	{
		$query .= " AND variety = '{$grapeVariety}'";
	}
	//range year
	if (!empty($startYear) && !empty($endYear))
	{
		$query .= " AND year>= '{$startYear}' AND year<= '{$endYear}'";
	}
	


	


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
	
		<?php showWineList($query); ?>
</body>

</html>