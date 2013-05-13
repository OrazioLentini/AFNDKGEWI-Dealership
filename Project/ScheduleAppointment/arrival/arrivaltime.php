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
$ArrivalTime = $_POST['ArrivalTime'];

$query = mysql_query("SELECT ServiceNum \n"
    . "FROM SCHEDULEAPPOINTMENT SA, VEHICLE V\n"
    . "WHERE SA.FirstName = '$FirstName' \n"
    . "AND SA.LastName = '$LastName' \n"
    . "AND V.Make= '$Make' \n"
    . "AND V.Model= '$Model' \n"
    . "AND V.Year= '$Year'\n"
    . "AND SA.CarID = V.CarID\n");

	$info = mysql_fetch_assoc($query);
	$ServiceNum = $info['ServiceNum'];

$query3 = mysql_query("SELECT ServiceLength FROM SERVICE S WHERE S.ServiceNum = '$ServiceNum'");
	$info2 = mysql_fetch_assoc($query3);
	$ServiceLength = $info2['ServiceLength'];


if ($ServiceNum > 0) {

$query2 = mysql_query("UPDATE SERVICE SET ArrivalTime = '$ArrivalTime' WHERE ServiceNum = '$ServiceNum' AND ArrivalTime = '00:00:00'");
echo "<b>Service Will Be Approximately:</b> $ServiceLength <b>Mins.</b>";

}

else echo "<b> No Appointment Was Scheduled.</b><br><br>";

echo '<a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';

mysql_close($con);
?>