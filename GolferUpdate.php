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
	$intGolferID = $_POST["intGolferID"];
	$intEventGolferID = $_POST["intEventGolferID"];
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
	
	
//Update information to database
	$updateGolfer = "UPDATE TGolfers 
					SET   strFirstName = '$txtFirstName'
						, strLastName = '$txtLastName'
						, strAddress = '$txtAddress'
						, strCity = '$txtCity'
						, intStateID = '$selState'
						, strZipCode = '$txtZip'
						, strPhoneNumber = '$txtPhone'
						, strEmail = '$txtEmail'
						, intShirtSizeID = '$selShirtSize'
						, intGenderID = '$selGender'
					WHERE intGolferID = '$intGolferID'";
					
//Update insertGolferTeam  break point - Success?
	if (!mysqli_query($link, $updateGolfer)) {
		die('Error: updateGolfer' . mysqli_error($link));
	}
	else
	{
		echo "updateGolfer Success";
	}


 // //Insert GolferEvent to database
	// $UpdateEventGolfer = "UPDATE TEventGolfers
						// SET intEventID = ''
							// intGolferID = ''
						// WHERE intEventGolferID = 'intEventGolferID';";

// //Insert GolferEvent  break point - Success?	
	// if (!mysqli_query($link, $insertEventGolfer)) {
		// die('Error: insertEventGolfer' . mysqli_error($link));
	// }


	// // echo 'Value of selTeam is:', $selTeam;
	
  //Insert Team information to database
	$updateGolferTeam = "UPDATE TEventGolferTeamAndClubs
							JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferTeamAndClubs.intEventGolferID
							JOIN TGolfers ON TGolfers.intGolferID = TEventGolfers.intGolferID
						SET 
						TEventGolferTeamAndClubs.intEventGolferID = '$intEventGolferID'
						,TEventGolferTeamAndClubs.intTeamsAndClubID = '$selTeam'
						WHERE TGolfers.intGolferID = '$intGolferID'";
							

//Update insertGolferTeam  break point - Success?
	if (!mysqli_query($link, $updateGolferTeam)) {
		die('Error: updateGolferTeam' . mysqli_error($link));
	}
	else
	{
		echo "updateGolferTeam Success";
	}


	header("Location: /WAPP1-CichonN/Content/Week13/ShowGolfers.php");


// if (!mysqli_query($link, $updateGolfer, $insertGolferTeam)) {
    // die('Error: ' . mysqli_error($link));
// }

mysqli_close($link);
?>