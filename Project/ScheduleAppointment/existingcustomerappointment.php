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


// RETRIEVING CUSTOMER ID
$sql =mysql_query("Select ID\n"
    . "From CUSTOMER C\n"
    . "Where C.FirstName ='$FirstName'\n"
    . "AND C.LastName = '$LastName'\n");

	$info = mysql_fetch_assoc($sql);
	$ID = $info['ID'];

$query = mysql_query("SELECT COUNT(*) FROM SCHEDULEAPPOINTMENT");
	$before = mysql_fetch_assoc($query);
	$CheckB = $before['COUNT(*)'];

// RETRIEVING CARID FORM SYSTEMS FOR INPUTTED NAME
$retrieve = mysql_query("SELECT CarID FROM VEHICLE V, CUSTOMER C \n"
    . "WHERE C.FirstName= '$FirstName' \n"
    . "AND C.LastName = '$LastName' \n"
    . "AND '$ID' = V.ID \n"
    . "AND V.Make= '$Make' \n"
    . "AND V.Model='$Model' \n"
    . "AND V.Year='$Year'");

	$info3 = mysql_fetch_assoc($retrieve);
	$CarID = $info3['CarID'];

// SCHEDULING APPOINTMENT
$sql2="INSERT INTO SCHEDULEAPPOINTMENT (FirstName, LastName, ID, CarID, SchDate_Time, SID)
VALUES
('$FirstName', '$LastName' , '$ID', '$CarID','$SchDate_Time', '$SID')";
	
	$exec = mysql_query($sql2, $con);
	$ServiceNum = mysql_insert_id(); 

// SELECTING SERVICE DESCRIPTION FORM TABLE
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

// INPUTS THE SCHEDULED APPOINTMENT INTO SYSTEM
if($CheckA > $CheckB) {
	
	$sql7 = "INSERT INTO SERVICE (Name, ServiceLength, SPrice, Date, ServiceNum)
	VALUES
	('$SType', '$SETime', '$SPrice', '$SchDate_Time', '$ServiceNum')";  

		$exec = mysql_query($sql7, $con);

	echo "<b>Appointment Set.</b>";
}

else echo "<b>Desired Date and or Time NOT AVAILABLE. Please Choose Another.</b>";

echo "<br><br>";
echo '<a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';

mysql_close($con);
?>