<?php
	require_once ('db.php');
	function showerror() 
	{
		die("Error " . mysql_errno() . " : " . mysql_error());
	}
	$msg_yearRange="";
	$msg_cost="";
	$wineName="";
	$wineryName="";
	$minStockNo="";
	$minOrderedNo="";
	$minCost="";
	$maxCost="";
	if(isset($_GET['submit']))
	{
		
		$wineName=trim($_GET['wineName']);
		$wineryName= trim($_GET['wineryName']);
		$minStockNo=trim($_GET['minStockNo']);
		$minOrderedNo=$_GET['minOrderedNo'];
		
		$minCost=$_GET['minCost'];
		$maxCost=$_GET['maxCost'];
	}
	
	
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
					//Run the query on the winestore through the connection
					$query = "select variety from grape_variety";
					$result = mysql_query($query, $connection);
					while ($row = mysql_fetch_row($result)) 
					{
						echo $row[0] ;
					}
					 
					while ($row = mysql_fetch_row($result)) 
					{
						echo $row[0] ;
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
	<h1><strong><span class="auto-style2">WineStore Management</span></strong></h1>
   	<form id="search_form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		<div id="formcontainer">
			<div class="row">
				<span class="label">Wine Name::</span>
				<span class="formw"><input type="text" size="20" id="wineName" name="wineName" value="<?php echo $wineName; ?>"/></span>
			</div>
			
			<div class="row">
                  <span class="label">Winery Name:</span>
                  <span class="formw"><input type="text" size="20" id="wineryName" name="wineryName" value="<?php echo $wineryName; ?>"/></span>
             </div>
		
			<div class="row">
                  <span class="label">Grape Variety:</span>
                  <span class="formw">
					<select id ="grapeVariety" name="grapeVariety">
					<?php
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
					$queryVariety = "select variety from grape_variety";
					$resultVariety = mysql_query($queryVariety, $connection);
					while ($row = mysql_fetch_row($resultVariety)) 
					{
						echo "\n".'<option value ="' .$row[0].'">'.$row[0]."</option>";
					}
					
					
					?>
					
                    </select>
                  </span>
             </div>

			 <div class="row">
                  <span class="label">Range of Years:</span>
                  <span class="formw">
                     <select id ="startYear" name="startYear">
                    <?php
					
					//Run the query on the winestore through the connection to get year
					$queryYear = "select distinct year from wine order by year";
					$resultYear = mysql_query($queryYear, $connection);
					//populate drop-down list
					while ($row = mysql_fetch_row($resultYear)) 
					{
						echo "\n".'<option value ="' .$row[0].'">'.$row[0]."</option>";
					}

					
					?>
                     </select>
					 to
					 <select id ="endYear" name="endYear">
					 <?php
                        //Run the query on the winestore through the connection to get year
					$queryYear = "select distinct year from wine order by year";
					$resultYear = mysql_query($queryYear, $connection);
					//populate drop-down list
					while ($row = mysql_fetch_row($resultYear)) 
					{
						echo "\n".'<option value ="' .$row[0].'">'.$row[0]."</option>";
					}
					mysql_close($connection); 
					
					?>
                     </select>
                  </span>
             </div>
			 
			 <?php echo "<div class='error'>".$msg_yearRange."</div>";?>
			 
			 <div class="row">
                  <span class="label">Minimum Number In Stock:</span>
                  <span class="formw"><input type="text" size="15" id="minStockNo" name="minStockNo" value="<?php echo $minStockNo; ?>"/></span>
             </div>
			 
			 <div class="row">
                  <span class="label">Minimum Number Ordered:</span>
                  <span class="formw"><input type="text" size="15" id="minOrderedNo" name="minOrderedNo" value="<?php echo $minOrderedNo; ?>"/></span>
             </div>
			 
			 
			 <div class="row">
                  <span class="label">Cost:</span>
                  <span class="formw">$<input type="text" size="10" id="minCost" name="minCost" value="<?php echo $minCost; ?>"/> to $<input type="text" size="10" id="maxCost" name="maxCost" value="<?php echo $maxCost; ?>"/></span>
             </div>
			 <?php echo "<div class='error'>".$msg_cost."</div>";?>
			 
			 <div class="row">
                  <span class="formw"><input type="submit" name="submit" value="Search"/></span>
             </div>
			 
		</div>
    </form>
			
 
 </body>
 
 </html>