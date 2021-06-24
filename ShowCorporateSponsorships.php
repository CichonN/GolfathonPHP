<?php
    session_start();
    if(!isset($_SESSION['login'])) {
        header('Location: /WAPP1-CichonN/Content/Week13/login.php'); die();
    }
?>

<html>
<body>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/Style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Admin.php';"><i class="fa fa-home"></i> Admin Home</button>

<h2>Corporate Sponsorships</h2>		

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
	$intEventCorporateSponsorTypeID = $GET["intEventCorporateSponsorTypeID"];

	//Display all sponsorships
	$sql = "
	SELECT 
		teventcorporatesponsorshiptypes.intEventCorporateSponsorTypeID 
		, TCorporateSponsorshipTypes.strCorporateSponsorshipType
		, TEvents.intEventYear
		, teventcorporatesponsorshiptypes.decSponsorshipCost
		, teventcorporatesponsorshiptypes.intSponsorshipAvailable
		, GROUP_CONCAT(TBenefits.strBenefitDescription) AS Benefits
		
	FROM teventcorporatesponsorshiptypes 
		LEFT JOIN TCorporateSponsorshipTypes ON TCorporateSponsorshipTypes.intCorporateSponsorshipTypeID = teventcorporatesponsorshiptypes.intCorporateSponsorTypeID
		LEFT JOIN TEvents ON TEvents.intEventID = teventcorporatesponsorshiptypes.intEventID
		LEFT JOIN TEventCorporateSponsorshipTypeBenefits ON TEventCorporateSponsorshipTypeBenefits.intEventCorporateSponsorshipTypeID = teventcorporatesponsorshiptypes.intEventCorporateSponsorTypeID
		LEFT JOIN TBenefits ON TBenefits.intBenefitID = TEventCorporateSponsorshipTypeBenefits.intBenefitID

	WHERE teventcorporatesponsorshiptypes.intSponsorshipAvailable > 0 AND TEvents.intEventYear = (SELECT MAX(intEventYear) AS CurrentEvent FROM TEvents)
	GROUP BY teventcorporatesponsorshiptypes.intEventCorporateSponsorTypeID";
		
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=1 align=center>";
			echo "<tr>";
				echo "<th>Update Sponsorship</th>";
				echo "<th>Sponsorship Type</th>";
				echo "<th>Event</th>";
				echo "<th>Sponorship Cost</th>";
				echo "<th>Qty Available</th>";
				echo "<th>Benefits</th>";
				
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            ?>       
			<tr>  
				 <td style="text-align:center"> <a href = "CorporateSponsorshipUpdate.php?intEventCorporateSponsorTypeID=<?php echo $row['intEventCorporateSponsorTypeID']?>">Update</a> </td> <?php
                echo "<td>" . $row['strCorporateSponsorshipType'] . "</td>";
				echo "<td>" . $row['intEventYear'] . "</td>";
                echo "<td>" . $row['decSponsorshipCost'] . "</td>";
                echo "<td>" . $row['intSponsorshipAvailable'] . "</td>";	
				echo "<td>" . $row['Benefits'] . "</td>";
				
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
	<br>
	<button style="display: block; margin: auto;" onclick="location.href = '/WAPP1-CichonN/Content/Week13/AddCorpSponsorship.php';">Add Corporate Sponsorship</button></a>

	</body>
</html>