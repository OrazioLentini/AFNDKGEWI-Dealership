<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$Date = $_POST['Date'];

//Retriving information to find all appointments on a given day
$query = mysql_query("SELECT FirstName, LastName, SchDate_Time\n"
    . "FROM SCHEDULEAPPOINTMENT SA\n"
    . "WHERE DATE( SA.SchDate_Time ) = '$Date'");


echo "<b>Appointments Scheduled For The Date: $Date</b><br><br>"; 



// PRINTS TABLE WITH BOARDERS
	echo "<table border='1'> 
	<tr> 
	<th> FirstName </th> 
	<th> LastName </th> 
	<th> Appointment </th> 
	</tr>";

		while($info2 = mysql_fetch_array($query))
		{
			Print "<tr>";
			Print "<td>".$info2['FirstName'] . "</td> " . "\n";
			Print "<td>".$info2['LastName'] . "</td> ";
			Print "<td>".$info2['SchDate_Time'] . "</td> ";
			Print "</tr>";
		}

	echo "</table>"; 


echo '<br><a href = "http://web.njit.edu/~ovl2/Project/ScheduleAppointment/arrival/arrivaltime.html"> Appointment Arrival </a>';
echo '<br><a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';
mysql_close($con);
?>
