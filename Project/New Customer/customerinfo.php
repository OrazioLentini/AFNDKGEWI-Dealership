<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$sql="INSERT INTO CUSTOMER (FirstName, LastName, Address, PhoneNum, CreditCardNum, ID)
VALUES
('$_POST[FirstName]','$_POST[LastName]','$_POST[Address]','$_POST[PhoneNum]', '$_POST[CreditCardNum]', '$_POST[ID]')";

echo "<b>Customer Informartion Stored.</b>";

if (!mysql_query($sql,$con))
  {
  	die('Error: ' . mysql_error());
  }

echo "<br>";
echo '<a href = "http://web.njit.edu/~ovl2/index.html"> Home </a>';
echo "<br>";
echo '<a href = "http://web.njit.edu/~ovl2/Project/Car Sold/carsold.html"> Enter Car Purchase </a>';
echo "<br>";
echo '<a href = "http://web.njit.edu/~ovl2/Project/ScheduleAppointment/newcustomerappointment.html"> Schedule New Customer For Car Service </a>';

mysql_close($con);
?>

