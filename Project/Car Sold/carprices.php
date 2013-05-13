<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$query = mysql_query("SELECT Make, Model, Year, Type, DealerCost FROM VEHICLE WHERE DealerCost > 0 GROUP BY MAKE,  MODEL ORDER BY Make");
	
echo "<b>Cars Available: </b><br><br>";

// PRINTS TABLE WITH BOARDERS
	echo "<table border='1'> 
	<tr> 
	<th> Make </th> 
	<th> Model </th> 
	<th> Year </th> 
	<th> Type </th>
	<th> Price </th> 
	</tr>";

	while($info2 = mysql_fetch_array($query))
	{
		Print "<tr>";
		Print "<td>".$info2['Make'] . "</td> " . "\n";
		Print "<td>"."<b></b>".$info2['Model'] . "</td> ";
		Print "<td>"."<b></b>".$info2['Year'] . "</td> ";
		Print "<td>"."<b></b>".$info2['Type'] . "</td> ";
		Print "<td>"."<b>$</b>".$info2['DealerCost'] . "</td> ";
		
		Print "</tr>";
	}

echo "</table>"; 

mysql_close($con);
?>
