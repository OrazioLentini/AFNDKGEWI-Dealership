<?php
$con = mysql_connect("sql.njit.edu","ovl2_proj","EWzpulq1");
if (!$con)
  {
  	die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ovl2_proj", $con);

$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];

// Retrieves the ID Of the Inputted Customer.
$sql =mysql_query("Select ID\n"
    . "From CUSTOMER C\n"
    . "Where C.FirstName ='$FirstName'\n"
    . "AND C.LastName = '$LastName'\n");

$info = mysql_fetch_assoc($sql);
	$ID = $info['ID'];

// CHECKS IF THE CUSTOMER EXISTS
$query = mysql_query("SELECT COUNT(*) FROM CUSTOMER WHERE FirstName = '$FirstName' AND LastName = '$LastName' AND ID = '$ID'");
	$valid = mysql_fetch_assoc($query);
	$Check = $valid['COUNT(*)'];

//IF CUSTOMER EXISTS WILL ENTER INFORMATION INTO SYSTEM
if ($Check > 0) {
$sql2="INSERT INTO VEHICLE (ID, Make, Model, Color, Year, DealerCost, Price, Type)
VALUES
($ID,'$_POST[Make]','$_POST[Model]','$_POST[Color]','$_POST[Year]','$_POST[DealerCost]', $_POST[DealerCost]-($_POST[DealerCost]*.2), '$_POST[Type]')";

		$exec = mysql_query($sql2, $con);
		$CarID = mysql_insert_id();
		$Make = $_POST[Make];
		$Model = $_POST[Model];
		$Type = $_POST[Type];
	
		
$sql3="INSERT INTO OPTIONS (Name, OPrice, ID, CarID)
VALUES
('$_POST[Name]','$_POST[OPrice]', $ID , $CarID)";

		$exec = mysql_query($sql3, $con);
		$TotalCost = $_POST[DealerCost] + $_POST[OPrice];

$sql4="INSERT INTO PURCHASE (Date, ID, TotalCost, CarID)
VALUES
(CURDATE(), $ID , $TotalCost , $CarID)";

		$exec = mysql_query($sql4, $con);

echo "<b>Car Purchase Information Added.</b>";
}

else "<b>Customer Does Not Exist In Our System.</b>";

echo "<br>";
echo '<a href = "http://web.njit.edu/~ovl2/Project/Print Receipt/print.html"> Print Receipt </a>';

mysql_close($con);
?>
