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
	$txtPledgeAmount = $_POST["txtPledgeAmount"];
	$dtmDateOfPledge = $_POST["dtmDateOfPledge"];
	
	$selGolfer = $_POST["selGolfer"];
	$selPaymentType = $_POST["selPaymentType"];
	$selPaymentStatus = 2;

	


//Insert Sponsor information to database
	$insertSponsor = "INSERT INTO TSponsors ( strFirstName, strLastName, strAddress, strCity, intStateID, strZipCode, strPhoneNumber, strEmail)
	VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity', '$selState', '$txtZip', '$txtPhone', '$txtEmail');";

if (!mysqli_query($link, $insertSponsor)) {
    die('Error: insertSponsor <br>' . mysqli_error($link));
}
else{
	echo "insertSponsor successful<br>";
}


//Insert Sponsor information to database
	$EventGolferSponsor = "INSERT INTO TEventGolferSponsors(intEventGolferID, intSponsorID, dtmDateOfPledge, decPledgePerHole, intPaymentTypeID, intPaymentStatusID) 
		
	VALUES ((SELECT intEventGolferID FROM TEventGolfers WHERE intGolferID = '$selGolfer')
			,(SELECT MAX(IntSponsorID) FROM TSponsors)
			,'$dtmDateOfPledge'
			,'$txtPledgeAmount'
			,'$selPaymentType'
		,'$selPaymentStatus');";

if (!mysqli_query($link, $EventGolferSponsor)) {
    die('Error: EventGolferSponsor <br>' . mysqli_error($link));
}
else{
	echo "EventGolferSponsor successful<br>";
}


	header("Location: /WAPP1-CichonN/Content/Week13/ThankYou.php ");




 mysqli_close($link);
?>