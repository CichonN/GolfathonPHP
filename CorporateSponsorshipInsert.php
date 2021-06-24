<html>

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

	$selEvent = $_POST["selEvent"];
	$selCorporateSponsorshipType = $_POST["selCorporateSponsorshipType"];	
	$txtCost = $_POST["txtCost"];
	$txtSponsorshipsAvailable = $_POST["txtSponsorshipsAvailable"];

	

//Insert Sponsor information to database
	$insertCorporateSponsorship = 
	"INSERT INTO teventcorporatesponsorshiptypes(intCorporateSponsorTypeID, intEventID, decSponsorshipCost, intSponsorshipAvailable) 
	VALUES ($selCorporateSponsorshipType, $selEvent, $txtCost, $txtSponsorshipsAvailable);";


if (!mysqli_query($link, $insertCorporateSponsorship)) {
    die('Error: insertCorporateSponsorship <br>' . mysqli_error($link));
}
	
	 foreach($_POST['chkBenefits'] as $val){
	  $insertBenefits = "INSERT INTO TEventCorporateSponsorshipTypeBenefits(intEventCorporateSponsorshipTypeID, intBenefitID)
						VALUES((SELECT MAX(intEventCorporateSponsorTypeID) FROM TEventCorporateSponsorshipTypes), $val)";
	if (!mysqli_query($link, $insertBenefits)) {
    die('Error: insertCorporateSponsorship <br>' . mysqli_error($link));
}
	}

	header("Location: /WAPP1-CichonN/Content/Week13/ShowCorporateSponsorships.php ");


 mysqli_close($link);
?>