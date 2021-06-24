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
	$intCorporateSponsorID = $_POST["intCorporateSponsorID"];
	$txtFirstName = $_POST["txtFirstName"];
	$txtLastName = $_POST["txtLastName"];
	$txtAddress = $_POST["txtAddress"];
	$txtCity = $_POST["txtCity"];
	$txtZip = $_POST["txtZip"];
	$txtPhone = $_POST["txtPhone"];
	$txtEmail = $_POST["txtEmail"];
	$selState = $_POST["selState"];

	
	
//Update information to database
	$updateCorpSponsor = "UPDATE TCorporateSponsors 
					SET   strFirstName = '$txtFirstName'
						, strLastName = '$txtLastName'
						, strAddress = '$txtAddress'
						, strCity = '$txtCity'
						, intStateID = '$selState'
						, strZipCode = '$txtZip'
						, strPhoneNumber = '$txtPhone'
						, strEmail = '$txtEmail'

					WHERE intCorporateSponsorID = '$intCorporateSponsorID'";
					
//Update insertGolferTeam  break point - Success?
	if (!mysqli_query($link, $updateCorpSponsor)) {
		die('Error: updateCorpSponsor' . mysqli_error($link));
	}


	header("Location: /WAPP1-CichonN/Content/Week13/ShowCorpSponsors.php");



mysqli_close($link);
?>