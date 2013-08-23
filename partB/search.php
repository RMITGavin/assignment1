<?php

	require_once('db.php');
	function showerror() 
	{
		die("Error " . mysql_errno() . " : " . mysql_error());
	}
  
	if (!($connection = @mysql_connect(DB_HOST, DB_USER, DB_PW))) 
	{
		die("Could not connect");
	}
	if (!(@ mysql_select_db("winestor", $connection)))
	{
		showerror();
	}

  
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Search WineStore</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <head>
 
 <body>  
	<h1><strong><span class="auto-style2">WineStore Mangement</span></strong></h1>
   	<form id="search_form" method="get" action="answer.php" >
		<div id="formcontainer">
			<div class="row">
				<span class="label">Wine Name::</span>
				<span class="formw"><input type="text" size="20" id="wineName" name="wineName" value="<?php echo $_GET['wineName']; ?>"/></span>
			</div>
			
			<div class="row">
                  <span class="label">Winery Name:</span>
                  <span class="formw"><input type="text" size="20" id="wineryName" name="wineryName" value="<?php echo $_GET['wineryName']; ?>"/></span>
             </div>
		
			<div class="row">
                  <span class="label">Grape Variety:</span>
                  <span class="formw">
                     <select id ="grapeVariety" name="grapeVariety">
                        some php code here.
                     </select>
                  </span>
             </div>
			 
			 <div class="row">
                  <span class="label">Range of Years:</span>
                  <span class="formw">
                     <select id ="startYear" name="startYear">
                        some php code here.
                     </select>
					 to
					 <select id ="endYear" name="endYear">
                        some php code here.
                     </select>
                  </span>
             </div>
			 
			 <?php echo "<div class='error'>".$msg_yearRang."</div>";?>
			 
			 <div class="row">
                  <span class="label">Minimum Number In Stock:</span>
                  <span class="formw"><input type="text" size="15" id="minStockNo" name="minStockNo" value="<?php echo $_GET['minStockNo']; ?>"/></span>
             </div>
			 
			 <div class="row">
                  <span class="label">Minimum Number Ordered:</span>
                  <span class="formw"><input type="text" size="15" id="minOrderedNo" name="minOrderedNo" value="<?php echo $_GET['minOrderedNo']; ?>"/></span>
             </div>
			 <?php echo "<div class='error'>".$msg_yearRang."</div>";?>
			 
			 <div class="row">
                  <span class="label">Cost:</span>
                  <span class="formw">$<input type="text" size="10" id="minCost" name="minCost" value="<?php echo $_GET['minCost']; ?>"/> to $<input type="text" size="10" id="maxCost" name="maxCost" value="<?php echo $_GET['maxCost']; ?>"/></span>
             </div>
			 <?php echo "<div class='error'>".$msg_cost."</div>";?>
			 
			 <div class="row">
                  <span class="formw"><input type="submit" name="search" value="Search"/></span>
             </div>
			 
		</div>
    </form>
			
 
 </body>
 
 </html>