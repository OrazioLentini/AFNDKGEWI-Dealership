<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$Make = $_POST['Make'];
$Model = $_POST['Model'];

$query = mysql_query("SELECT COUNT(*) FROM VEHICLETYPEOPTIONS WHERE Make = '$Make' AND Model = '$Model'");
	$before = mysql_fetch_assoc($query);
	$Check = $before['COUNT(*)'];

echo "<b> OPTIONS AVAILABLE $Make $Model:</b><br>";

if($Check > 0) {
$sql = mysql_query("SELECT OPrice, OName FROM VEHICLETYPEOPTIONS  WHERE Make = '$Make' AND Model = '$Model'"); 
	
	echo "<br>";
	// PRINTS TABLE WITH BOARDERS
	echo "<table border='1'> 
	<tr> 
	<th> Option </th> 
	<th> Price </th> 
	</tr>";

	while($info2 = mysql_fetch_array($sql))
	{
		Print "<tr>";
		Print "<td>".$info2['OName'] . "</td> " . "\n";
		Print "<td>"."<b>$</b>".$info2['OPrice'] . "</td> ";
		Print "<tr>";
	}

	echo "</table>"; 

}

else "<b>NO OPTIONS AVAILABLE.</b>";

mysql_close($con);
?>
