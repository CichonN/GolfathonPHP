<html>
<body>


<br>
<?php

	$servername = "itd2.cincinnatistate.edu";
	$username = "ncichon";
	$password = "0680010";
	$dbname = "WAPP1CichonN";

$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    die('Could not connect: ' . mysqli_error($link));
}

$db_selected = mysqli_select_db($link, $dbname);

if (!$db_selected) {
    die('Cannot access' . $dbname . ': ' . mysqli_error($link));
}

	$txtEvent = $_POST["txtEvent"];


//Insert Event information to database
	$insertEvent = "INSERT INTO TEvents(intEventYear) VALUES ('$txtEvent');";

if (!mysqli_query($link, $insertEvent)) {
    die('Error: insertEvent <br>' . mysqli_error($link));
}
else{
	echo "insertEvent successful<br>";
}


	header("Location: /WAPP1-CichonN/Content/Week13/ShowEvents.php ");


 mysqli_close($link);
?>