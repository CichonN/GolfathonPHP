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
	$intEventID = $_POST["intEventID"];
	$txtEvent = $_POST["txtEvent"];

	
	
//Update information to database
	$updateEvent = "UPDATE TEvents 
					SET   intEventYear = '$txtEvent'
					WHERE intEventID = '$intEventID'";
					
//Update insertGolferTeam  break point - Success?
	if (!mysqli_query($link, $updateEvent)) {
		die('Error: updateEvent' . mysqli_error($link));
	}


	header("Location: /WAPP1-CichonN/Content/Week13/ShowEvents.php");



mysqli_close($link);
?>