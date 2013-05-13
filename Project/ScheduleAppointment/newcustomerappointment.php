<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Make = $_POST['Make'];
$Model = $_POST['Model'];
$Year = $_POST['Year'];
$SchDate_Time = $_POST['SchDate_Time'];
$SID = $_POST['SID'];

// SELECTING CUSTOMER ID
$sql =mysql_query("Select ID\n"
    . "From CUSTOMER C\n"
    . "Where C.FirstName ='$FirstName'\n"
    . "AND C.LastName = '$LastName'\n");

	$info = mysql_fetch_assoc($sql);
	$ID = $info['ID'];

$query = mysql_query("SELECT COUNT(*) FROM SCHEDULEAPPOINTMENT");
	$before = mysql_fetch_assoc($query);
	$CheckB = $before['COUNT(*)'];

// SCHEDULES AN APPOINTMENT
$sql2="INSERT INTO SCHEDULEAPPOINTMENT (FirstName, LastName, ID, CarID, SchDate_Time, SID)
VALUES
('$FirstName', '$LastName' , '$ID', '$CarID','$SchDate_Time', '$SID')";
	
	$exec = mysql_query($sql2, $con); 
	$ServiceNum = mysql_insert_id();

$service = mysql_query("SELECT SType, SPrice, SETime \n"
    . "FROM SCHEDULEAPPOINTMENT SA, SERVICETYPE ST\n"
    . "WHERE '$SID' = ST.SID");

	$serv = mysql_fetch_assoc($service);
	$SType = $serv['SType'];
	$SPrice = $serv['SPrice'];
	$SETime = $serv['SETime'];

$query2 = mysql_query("SELECT COUNT(*) FROM SCHEDULEAPPOINTMENT");
	$after = mysql_fetch_assoc($query2);
	$CheckA = $after['COUNT(*)'];

// CHECKS IF APPOINTMENT SCHEDULED AND INSERTS INFORMATION INTO SYSTEM
if($CheckA > $CheckB){

	$sql4 = "INSERT INTO VEHICLE (ID, Make, Model, Year, DealerCost, Price)
	VALUES
	($ID, '$Make', '$Model', '$Year', '0' , '0')";

		$exec = mysql_query($sql4, $con);
		$CarID = mysql_insert_ID(); 

		$update = mysql_query("UPDATE SCHEDULEAPPOINTMENT SET CarID = '$CarID' WHERE CarID = '0'");
		echo "<b>Appointment Set.</b>";
	
	$sql5 = "INSERT INTO SERVICE (Name, ServiceLength, SPrice, Date, ServiceNum)
	VALUES
	('$SType', '$SETime', '$SPrice', '$SchDate_Time', '$ServiceNum')";  

		$exec = mysql_query($sql5, $con);
}

else echo "<b>Desired Date and or Time NOT AVAILABLE. Please Choose Another.</b><br><br>";

echo '<a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';

mysql_close($con);
?>
