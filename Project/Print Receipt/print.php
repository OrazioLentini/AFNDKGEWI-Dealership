<?php

$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");

if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Date = $_POST['Date'];

//RETRIEVES CUSTOMER INFORMATION FORM SYSTEM
$sql =mysql_query("Select FirstName, LastName, Address, PhoneNum, CreditCardNum, Make, Model, Type, Color, Year, DealerCost, Name, OPrice, Date, TotalCost\n"
. "From CUSTOMER C, VEHICLE V, PURCHASE P, OPTIONS O\n"
. "Where C.ID = V.ID\n"
. "AND C.FirstName='$FirstName'\n"
. "And C.LastName='$LastName'\n"
. "AND P.Date = '$Date'\n"
. "AND C.ID = O.ID\n"
. "AND C.ID = P.ID\n" );

$info = mysql_fetch_assoc($sql);

	$FirstName = $info['FirstName'];
	$LastName = $info['LastName'];
	$Address = $info['Address'];
	$PhoneNum = $info['PhoneNum'];
	$CreditCardNum = $info['CreditCardNum'];
	$Make = $info['Make'];
	$Model = $info['Model'];
	$Type = $info['Type'];
	$Color = $info['Color'];
	$Year = $info['Year'];
	$DealerCost = $info['DealerCost'];
	$Name = $info['Name'];
	$OPrice = $info['OPrice'];
	$Date = $info['Date'];
	$TotalCost = $info['TotalCost']; 

// PRINTS CUSTOMER INFORMATION
echo "<b>THANK YOU FOR CHOOSING AFNDKGEWI DEALERSHIP FOR YOUR CAR PURCHASE</b><br><br>";
echo "<b>CUSTOMER RECIEPT COPY </b><br><br>";
echo "<b>CUSTOMER INFORMATION: </b><br>";
echo "<b>Name:</b> $FirstName $LastName <br>";
echo "<b>Address:</b> $Address <br>";
echo "<b>Phone Number:</b> $PhoneNum <br>";
echo "<b>Credit Card Number: </b> $CreditCardNum <br><br>";
echo "<b>VEHICLE INFORMATION: </b><br>";
echo "<b>Make: </b>$Make <b>Model:</b> $Model <b> Year:</b> $Year <br>";
echo "<b>Color:</b> $Color <b>Type:</b> $Type<br>";
echo "<b>Price: $</b>$DealerCost <br><br>";
echo "<b>Options:</b> $Name<b> Price: $</b>$OPrice <br><br>";
echo "<b>Total Cost: $</b>$TotalCost <br><br>";

echo '<a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';

?>