<?php
    session_start();
    if(!isset($_SESSION['login'])) {
        header('Location: /WAPP1-CichonN/Content/Week13/login.php'); die();
    }
?>
<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Home.php';"><i class="fa fa-home"></i> Public Home</button></a>
<html>
    <head>
        <title>Admin Page</title>
    </head>
    <body>
        <!--
Name: Neina Cichon
Class: IT 117
Abstract: Golfathon
Date: 11/18/2020

-->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/Style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	

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

 $query = "SELECT intEventID, MAX(intEventYear) AS CurrentEvent FROM TEvents";

	if ($result = mysqli_query($link, $query)) {

		/* fetch associative array */
		while ($row = mysqli_fetch_assoc($result)) {
			printf ("<h2>Golfathon %s Admin Home</h2>", $row["CurrentEvent"]);
		}
	}
?>
	<style>
	.w3-button {width:150px}
	</style>		
		<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/AddCorporateSponsor.php';" style="width:300px; display: block; margin: auto;">Purchase Corporate Sponsorships</button>
		<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/ShowCorporateSponsorships.php';" style="width:300px; display: block; margin: auto;">Manage Corporate Sponsorships</button>
		<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/ShowCorpSponsors.php';" style="width:300px; display: block; margin: auto;">Manage Corporate Sponsors</button>
		<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/ShowEvents.php';" style="width:300px; display: block; margin: auto;">Manage Events</button>
		<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/ShowGolfers.php';" style="width:300px; display: block; margin: auto;">Manage Golfers</button>
		<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/ShowSponsors.php';" style="width:300px; display: block; margin: auto;">Manage Sponsors</button>
		<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Logout.php';" style="width:300px; display: block; margin: auto;"><i class="fa fa-sign-out"></i> Logout</button>

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

?><h3>Corporate Sponsorships</h3><?php
	//Display all sponsorships
	$sql = "SELECT 
    TCorporateSponsors.intCorporateSponsorID
    , TCorporateSponsors.strFirstName
    , TCorporateSponsors.strLastName
    , TCorporateSponsorshipTypes.strCorporateSponsorshipType
    , TEvents.intEventYear
FROM TCorporateSponsors 
	JOIN TEventCorporateSponsorshipTypeCorporateSponsors ON TEventCorporateSponsorshipTypeCorporateSponsors.intCorporateSponsorID = TCorporateSponsors.intCorporateSponsorID
    JOIN teventcorporatesponsorshiptypes ON teventcorporatesponsorshiptypes.intEventCorporateSponsorTypeID = TEventCorporateSponsorshipTypeCorporateSponsors.intEventCorporateSponsorshipTypeID
    JOIN TCorporateSponsorshipTypes ON TCorporateSponsorshipTypes.intCorporateSponsorshipTypeID = teventcorporatesponsorshiptypes.intCorporateSponsorTypeID
    JOIN TEvents ON TEvents.intEventID = teventcorporatesponsorshiptypes.intEventID
WHERE TEvents.intEventYear = (SELECT MAX(intEventYear) AS CurrentEvent FROM TEvents);";

	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=1 align=center>";
			echo "<tr>";
				echo "<th>First Name</th>";
				echo "<th>Last Name</th>";
				echo "<th>Sponsorship Type</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
				echo "<td>" . $row['strFirstName'] . "</td>";
				echo "<td>" . $row['strLastName'] . "</td>";
                echo "<td>" . $row['strCorporateSponsorshipType'] . "</td>";
			echo "</tr>";
        }
		
		echo "</table>";

        // Free result set
        mysqli_free_result($result);
    } 
	else{
        echo "<p style='text-align:center'>No records matching your query were found.</p>";
    }
} 
else{
    echo "ERROR: $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>
    </body> 
</html>