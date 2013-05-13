<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);


$SDate = $_POST['Date'];
$EDate = $_POST['EDate'];

// COUNTS NUMBER OF CARS SOLD DURING TIME PERIOD
$sql = mysql_query("SELECT COUNT(*) \n"
    . "FROM PURCHASE P\n"
    . "WHERE P.Date >= '$SDate'\n"
    . "AND P.Date <= '$EDate'");


$info = mysql_fetch_assoc($sql);
	$Date = $info['COUNT(*)'];
	
	echo "<b>SALE STATISTICS BETWEEN $SDate - $EDate: </b><br><br>";
	echo "<b>Total Number of Cars Sold: </b> $Date<br>";

// SELECTING CARS THAT WERE SOLD GROUPED BY MAKE MODEL YEAT, AND GETTING PROFIT
$sql2 = mysql_query("SELECT Make, Model, Year, DealerCost, Price, COUNT(*) , ((DealerCost - Price) * COUNT( * )) AS Profit\n"
    . "FROM VEHICLE V, PURCHASE P\n"
    . "WHERE V.CarID = P.CarID\n"
    . "AND V.DealerCost <> 0\n"
    . "AND P.Date >= '$SDate'\n"
    . "AND P.Date <= '$EDate'\n"
    . "GROUP BY Make, Model, YEAR");

// PRINTS TABLE WITH BOARDERS

echo "<table border='1'> 
<tr> 
<th> Make </th> 
<th> Model </th> 
<th> Year </th> 
<th> Amount Sold </th> 
<th> Profit </th> 
</tr>";


while($info2 = mysql_fetch_array($sql2))
	{
		Print "<tr>";
		Print "<td>".$info2['Make'] . "</td> " . "\n";
		Print "<td>".$info2['Model'] . "</td> ";
		Print "<td>".$info2['Year'] . "</td> ";
		Print "<td>".$info2['COUNT(*)'] . "</td> ";
		Print "<td>"."<b>$</b>".$info2['Profit'] . "</td> ";
		Print "</tr>";
	}
echo "</table>"; 
echo "<br><br>";
echo '<a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';

mysql_close($con);
?>
