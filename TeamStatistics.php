<html>
<body>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/Style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Home.php';"><i class="fa fa-home"></i> Home</button></a>



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

//$query = "SELECT Name, CountryCode FROM City ORDER by ID DESC LIMIT 50,5";

if ($result = mysqli_query($link, $query)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
        printf ("<h2>Golfathon %s - Team Statistics</h2>", $row["CurrentEvent"]);
    }

    // /* free result set */
    // mysqli_free_result($result);
}

$eventDonation = "
SELECT SUM(TEventGolferSponsors.decPledgePerHole) AS EventDonation 
FROM TEventGolferSponsors 
	JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferSponsors.intEventGolferID 
	JOIN TEvents ON TEvents.intEventID = TEventGolfers.intEventID 
WHERE TEvents.intEventYear = (SELECT MAX(intEventYear) AS CurrentEvent FROM TEvents)
GROUP BY TEvents.intEventYear;";



if ($result = mysqli_query($link, $eventDonation)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
        printf ("<h3>Event Total: $%01.2f </h3>", $row["EventDonation"]);
    }

    /* free result set */
    mysqli_free_result($result);
}


//Display all Teams
$sql = "
	SELECT SUM(TEventGolferSponsors.decPledgePerHole) AS AmountRaised 
		, CONCAT(TTypesOfTeams.strTypeOfTeam, ' ', TLevelOfTeams.strLevelOfTeam, ' ', TGenders.strGender) AS Team 
	FROM 
    	TEventGolferSponsors
        RIGHT JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferSponsors.intEventGolferID
        RIGHT JOIN TEventGolferTeamAndClubs ON TEventGolferTeamAndClubs.intEventGolferID = TEventGolfers.intEventGolferID
        RIGHT JOIN TTeamsAndClubs ON TTeamsAndClubs.intTeamsAndClubID = TEventGolferTeamAndClubs.intTeamsAndClubID
        RIGHT JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID 
		RIGHT JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID 
		RIGHT JOIN TGenders ON TGenders.intGenderID = TTeamsAndClubs.intGenderID

	GROUP BY Team 
	ORDER BY AmountRaised DESC;";
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){
				echo "<table border=1 align=center>";
				echo "<tr>";
					echo "<th>Team</th>";
					echo "<th>Amount Raised</th>";
					echo "<th>Donor List</th>";
				echo "</tr>";
			while($row = mysqli_fetch_array($result)){
				?>       
				  
				<?php

					if($row['AmountRaised'] >= '2000')
					{
						echo "<tr style='font-weight:bold;color:Red' >";
						echo "<td>" . $row['Team'] . "</td>";
						echo "<td >$ " . $row['AmountRaised'] . "</td>";		
					}
					else{
						echo "<tr>";
						echo "<td>" . $row['Team'] . "</td>";
						echo "<td>$" . $row['AmountRaised'] . "</td>";
					}
					?>
					<td> <a href = "TeamDonorList.php?Team=<?php echo $row['Team']?>"> Donor List </a> </td> <?php
			}
			echo "</table>";
			// echo "<br>";
			
			// echo "<table>";
				// echo"<tr>";
					// echo"<td style='text-align:center'>";
						// echo"<a href='/WAPP1-CichonN/Content/Week11/AddGolfer.php'><button>Add Golfer</button></a>";
					// echo"</td>";
				// echo"</tr>";
			// echo "</table>";

			// Free result set
			mysqli_free_result($result);
		} else{
			echo "No records matching your query were found.";
		}
	} else{
		echo "ERROR: $sql. " . mysqli_error($link);
	}
mysqli_close($link);
?>


</body>
</html>