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
	$selSponsorship = $_POST["selSponsorship"];



//Insert Corporate Sponsor information to database
	$insertCorporateSponsor = "INSERT INTO TCorporateSponsors ( strFirstName, strLastName, strAddress, strCity, intStateID, strZipCode, strPhoneNumber, strEmail)
	VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity', '$selState', '$txtZip', '$txtPhone', '$txtEmail');";

if (!mysqli_query($link, $insertCorporateSponsor)) {
    die('Error: insertCorporateSponsor <br>' . mysqli_error($link));
}
else{
	echo "insertCorporateSponsor successful<br>";
}

//Insert Corporate Sponsorship information to database
	$insertCorporateSponsorship = "INSERT INTO TEventCorporateSponsorshipTypeCorporateSponsors(intEventCorporateSponsorshipTypeID, intCorporateSponsorID) 
									VALUES ('$selSponsorship', (SELECT MAX(intCorporateSponsorID) FROM TCorporateSponsors));";

if (!mysqli_query($link, $insertCorporateSponsorship)) {
    die('Error: insertCorporateSponsorship <br>' . mysqli_error($link));
}
else{
	echo "insertCorporateSponsorship successful<br>";
}


//Update Sponsorship Qty
	$UpdateSponsorshipQty = "UPDATE teventcorporatesponsorshiptypes 
							SET intSponsorshipAvailable = intSponsorshipAvailable - 1 
							WHERE intEventCorporateSponsorTypeID = '$selSponsorship';";

if (!mysqli_query($link, $UpdateSponsorshipQty)) {
    die('Error: UpdateSponsorshipQty <br>' . mysqli_error($link));
}
else{
	echo "UpdateSponsorshipQty successful<br>";
}




	header("Location: /WAPP1-CichonN/Content/Week13/ShowCorpSponsors.php ");


 mysqli_close($link);
?>