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

	$txtFirstName = $_POST["txtFirstName"];
	$txtLastName = $_POST["txtLastName"];
	$txtAddress = $_POST["txtAddress"];
	$txtCity = $_POST["txtCity"];
	$txtZip = $_POST["txtZip"];
	$txtPhone = $_POST["txtPhone"];
	$txtEmail = $_POST["txtEmail"];
	$selState = $_POST["selState"];
	$selShirtSize = $_POST["selShirtSize"];
	$selGender = $_POST["selGender"];
	$selTeam = $_POST["selTeam"];
	
	


//Insert Golfer information to database
	$insertGolfer = "INSERT INTO TGolfers ( strFirstName, strLastName, strAddress, strCity, intStateID, strZipCode, strPhoneNumber, strEmail, intShirtSizeID, intGenderID)
	VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity', '$selState', '$txtZip', '$txtPhone', '$txtEmail', '$selShirtSize', '$selGender');";

//Insert Golfer break point - Success?
	if (!mysqli_query($link, $insertGolfer)) {
		die('Error: failed to insert golfer' . mysqli_error($link));
	}

	

//Insert GolferEvent to database
	$insertEventGolfer = "INSERT INTO TEventGolfers(intEventID, intGolferID) VALUES ((SELECT intEventID FROM TEvents WHERE intEventYear = (SELECT MAX(intEventYear) FROM TEvents)), (SELECT MAX(intGolferID) FROM TGolfers));";



//Insert GolferEvent  break point - Success?	
	if (!mysqli_query($link, $insertEventGolfer)) {
		die('Error:  failed to add golfer to Event' . mysqli_error($link));
	}


	// echo 'Value of selTeam is:', $selTeam;
	
 //Insert Team information to database
	 $insertGolferTeam = "INSERT INTO TEventGolferTeamAndClubs(intEventGolferID, intTeamsAndClubID) VALUES ((SELECT MAX(intEventGolferID) FROM TEventGolfers), '$selTeam')";

//Insert insertGolferTeam  break point - Success?
	if (!mysqli_query($link, $insertGolferTeam)) {
		die('Error: failed to add golfer to Team' . mysqli_error($link));
	}



	header("Location: /WAPP1-CichonN/Content/Week13/ShowGolfers.php");



// if (!mysqli_query($link, $insertGolfer, $intEventID, $intGolferID, $intEventGolferID, $insertEventGolfer, $EventGolferTeamID, $insertGolferTeam)) {
    // die('Error: ' . mysqli_error($link));
// }
// else{
	// echo "New records created successfully";
// }

 mysqli_close($link);
?>