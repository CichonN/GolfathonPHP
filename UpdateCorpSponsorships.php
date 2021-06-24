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
	$intEventCorporateSponsorshipTypeID = $_POST["intEventCorporateSponsorshipTypeID"];
	$intEventCorporateSponsorTypeID = $_POST["intEventCorporateSponsorTypeID"];
	$selEvent = $_POST["selEvent"];
	$selCorporateSponsorshipType = $_POST["selCorporateSponsorshipType"];	
	$txtCost = $_POST["txtCost"];
	$txtSponsorshipsAvailable = $_POST["txtSponsorshipsAvailable"];


//Insert Sponsor information to database
	$updateCorporateSponsorship = 
	"UPDATE teventcorporatesponsorshiptypes 
	SET 
		intCorporateSponsorTypeID = '$selCorporateSponsorshipType'
		, intEventID = '$selEvent'
		, decSponsorshipCost  = '$txtCost'
		, intSponsorshipAvailable = '$txtSponsorshipsAvailable' 
	WHERE intEventCorporateSponsorTypeID = '$intEventCorporateSponsorshipTypeID'";
	

if (!mysqli_query($link, $updateCorporateSponsorship)) {
    die('Error: updateCorporateSponsorship <br>' . mysqli_error($link));
}



	header("Location: /WAPP1-CichonN/Content/Week13/ShowCorporateSponsorships.php ");


 mysqli_close($link);
?>