<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$DateTime = $_POST['DateTime'];

// SELECT CAR INFORMATION THAT WAS SCHEDULED
$query = mysql_query("SELECT Make, Model, Year, ServiceNum FROM SCHEDULEAPPOINTMENT SA, VEHICLE V WHERE SA.FirstName = '$FirstName' AND SA.LastName = '$LastName' AND SA.SchDate_Time = '$DateTime' AND V.CarID = SA.CarID");

	$info = mysql_fetch_assoc($query);
	$Make = $info['Make'];
	$Model = $info['Model'];
	$Year = $info['Year'];
	$ServiceNum = $info['ServiceNum'];
	
// RETRIEVING CUSTOMER ID
$query4 = mysql_query("SELECT ID FROM SCHEDULEAPPOINTMENT SA WHERE SA.FirstName = '$FirstName' AND SA.LastName = '$LastName'");

	$info4 = mysql_fetch_assoc($query4);
	$ID = $info4['ID'];

// RETRIEVING MORE CUSTOMER INFORMATION
$query3 = mysql_query("SELECT Address, PhoneNum, CreditCardNum FROM CUSTOMER C WHERE C.FirstName = '$FirstName'AND C.LastName = '$LastName' AND C.ID = '$ID'");

	$info3 = mysql_fetch_assoc($query3);
	$Address = $info3['Address'];
	$PhoneNum = $info3['PhoneNum'];
	$CreditCardNum = $info3['CreditCardNum'];

// RETRIEVING SERVICE INFORMATION	
$query2 = mysql_query("SELECT Name, ServiceLength, SPrice, ArrivalTime FROM SERVICE S WHERE S.ServiceNum = '$ServiceNum' AND S.Date = '$DateTime'");
	
	$info2 = mysql_fetch_assoc($query2);
	$Name = $info2['Name'];
	$ServiceLength = $info2['ServiceLength'];
	$SPrice = $info2['SPrice'];
	$ArrivalTime = $info2['ArrivalTime'];

$query5 = mysql_query("SELECT ADDTIME('$DateTime' , '$ServiceLength') as EndTime");
	
	$info5 = mysql_fetch_assoc($query5);
	$EndTime = $info5['EndTime'];

$sql = mysql_query("UPDATE SERVICE SET EndTime = '$EndTime' WHERE ServiceNum = '$ServiceNum' AND ET = '0000/00/00 00:00:00'");

//PRINTING RECEIPT
echo "<b> THANK YOU FOR CHOOSING AFNDKGEWI DEALERSHIP FOR YOUR CAR SERVICE </b><br><br>";	
echo "<b> SERVICE RECEIPT</b><br><br>";
echo "<b> CUSTOMER INFORMATION:</b><br>";
echo "<b> CustomerName: </b> $FirstName $LastName <br>";
echo "<b> Address: </b> $Address <br>";
echo "<b> Phone Number </b> $PhoneNum <br>";
echo "<b> Credit Card Number: </b> $CreditCardNum <br><br>";
echo "<b> VEHICLE INFORMATION:</b><br>";
echo "<b> Make: </b> $Make <b> Model: </b> $Model <b> Year: </b> $Year <br><br>";
echo "<b> SERVICE REPORT: </b> <br> ";
echo "<b> Scheduled Date/Time: </b> $DateTime <br>";
echo "<b> Arrival Time: </b> $ArrivalTime <br><br>";
echo "<b> Service Name: </b> $Name <b> Service Price: </b> <b>$</b>$SPrice <b><br> Service Length: </b> $ServiceLength<b>min</b><br><br>";
echo "<b> Service Completed: </b> $EndTime <br><br>";
echo "<b> TOTAL COST OF SERVICE: $</b>$SPrice <br><br>"; 



echo '<a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';

mysql_close($con);
?>