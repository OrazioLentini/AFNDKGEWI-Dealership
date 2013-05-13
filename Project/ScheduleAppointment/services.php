<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

echo "<b> AVAILABLE SERVICES: </b><br><br>";
$sql = mysql_query("SELECT SID, SType FROM SERVICETYPE");

// PRINTS TABLE WITH BOARDERS
	echo "<table border='1'> 
	<tr> 
	<th> SID </th> 
	<th> Service Name </th> 
	</tr>";

	while($info2 = mysql_fetch_array($sql))
		{
			Print "<tr>";
			Print "<td>".$info2['SID'] . "</td> " . "\n";
			Print "<td>".$info2['SType'] . "</td> ";
			Print "<tr>";
		}

	echo "</table>"; 

mysql_close($con);
?>
