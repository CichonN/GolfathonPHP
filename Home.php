<html>
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

	<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Login.php';"><i class="fa fa-user"></i> Login</button></a>

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
        printf ("<h2>Golfathon %s Home Page</h2>", $row["CurrentEvent"]);
    }

    // /* free result set */
    // mysqli_free_result($result);
}



//$query = "SELECT Name, CountryCode FROM City ORDER by ID DESC LIMIT 50,5";

// if ($result = mysqli_query($link, $amountRaised)) {

    // /* fetch associative array */
    // while ($row = mysqli_fetch_assoc($result)) {
        // printf ("<h3>Event Total: $%01.2f </h3>", $row["AmountRaised"]);
    // }

  //  /* free result set */
  //  mysqli_free_result($result);
//}
 

?>


<style>
.w3-button {width:150px}
</style>		

	
				<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/AddGolfer.php';" style="width:300px; display: block; margin: auto;">Register a Golfer</button>
				<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/ShowGolfers.php';" style="width:300px; display: block; margin: auto;">All Golfers</button>
				<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/AddSponsor.php';" style="width:300px; display: block; margin: auto;">Make a Donation</button>
				<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/GolferStatistics.php';" style="width:300px; display: block; margin: auto;">Golfer Statistics</button>
				<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/TeamStatistics.php';" style="width:300px; display: block; margin: auto;">Team Statistics</button>



	<br>
	

	<table border="1" align=center >
		<tr>
			<td style='text-align:left' width='200px'><span style="font-weight:bold">
				Amount Raised:
			</span></td>
			
			<?php 
			$amountRaised = "
				SELECT SUM(TEventGolferSponsors.decPledgePerHole) AS AmountRaised 
				FROM TEventGolferSponsors 
					JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferSponsors.intEventGolferID 
					JOIN TEvents ON TEvents.intEventID = TEventGolfers.intEventID 
				WHERE TEvents.intEventYear = (SELECT MAX(intEventYear) AS CurrentEvent FROM TEvents)
				GROUP BY TEvents.intEventYear;";
			
				if ($result = mysqli_query($link, $amountRaised)) 
				{
					while($row = mysqli_fetch_array($result)){
					echo"<td>$" . number_format($row['AmountRaised']) . "</td>";
					
				// /* fetch associative array */
				// while ($row = mysqli_fetch_assoc($result)) {
					// echo"<td>" . $row['AmountRaised'] . "</td>";
					}
				 }
				
			?>
			
		</tr>
		<tr>
			<td style='text-align:left' width='200px'><span style="font-weight:bold">
				Golfer who raised the most money:
			</span></td>
			<?php 
			$leadGolfer = "
				SELECT 
				 CONCAT(TGolfers.strFirstName, ' ', TGolfers.strLastName) AS LeadGolfer	, SUM(TEventGolferSponsors.decPledgePerHole) AS PledgeTotal
					 
				FROM TGolfers 
					JOIN TEventGolfers ON TEventGolfers.intGolferID = TGolfers.intGolferID
					JOIN TEvents ON TEvents.intEventID = TEventGolfers.intEventID 
					JOIN TEventGolferSponsors ON TEventGolferSponsors.intEventGolferID = TEventGolfers.intEventGolferID

				GROUP BY TGolfers.intGolferID
				ORDER BY PledgeTotal DESC
				LIMIT 1;";
			
				if ($result = mysqli_query($link, $leadGolfer)) 
				{
					while($row = mysqli_fetch_array($result)){
					echo"<td>" . $row['LeadGolfer'] . "</td>";
					
				// /* fetch associative array */
				// while ($row = mysqli_fetch_assoc($result)) {
					// echo"<td>" . $row['AmountRaised'] . "</td>";
					}
				 }
				
			?>
		</tr>
		<tr>
			<td style='text-align:left' width='200px'><span style="font-weight:bold">
				Team that raised the most money:
			</span></td>
			<?php 
			$leadTeam = "
				SELECT SUM(TEventGolferSponsors.decPledgePerHole) AS AmountRaised 
					, CONCAT(TTypesOfTeams.strTypeOfTeam, ' ', TLevelOfTeams.strLevelOfTeam, ' ', TGenders.strGender) AS LeadTeam 
				FROM TEventGolferSponsors 
					LEFT JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferSponsors.intEventGolferID 
					LEFT JOIN TEventGolferTeamAndClubs ON TEventGolferTeamAndClubs.intEventGolferID = TEventGolfers.intEventGolferID 
					LEFT JOIN TTeamsAndClubs ON TTeamsAndClubs.intTeamsAndClubID = TEventGolferTeamAndClubs.intTeamsAndClubID 
					LEFT JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID 
					LEFT JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID 
					JOIN TGenders ON TGenders.intGenderID = TTeamsAndClubs.intGenderID 
				GROUP BY LeadTeam 
				ORDER BY AmountRaised DESC 
				LIMIT 1";
			
				if ($result = mysqli_query($link, $leadTeam)) 
				{
					while($row = mysqli_fetch_array($result)){
					echo"<td>" . $row['LeadTeam'] . "</td>";
					
					}
				 }
				
			?>

		</tr>
		<tr>
			<td style='text-align:left' width='200px'><span style="font-weight:bold">
				Number of golfers playing in the event:
			</span></td>
			<?php 
			$numberGolfers = "
				SELECT COUNT(intGolferID) AS GolferCount 
				FROM TEventGolfers 
					JOIN TEvents ON TEvents.intEventID = TEventGolfers.intEventID
				WHERE  TEvents.intEventYear = (SELECT MAX(intEventYear) FROM TEvents)
				GROUP BY TEvents.intEventYear;";
			
				if ($result = mysqli_query($link, $numberGolfers)) 
				{
					while($row = mysqli_fetch_array($result)){
					echo"<td>" . $row['GolferCount'] . "</td>";
					
					}
				 }
				
			?>
		</tr>
		<tr>
			<td style='text-align:left' width='200px'><span style="font-weight:bold">
				Recent Donors:
			</span></td>
			<?php 
			$recentPledge = "
				SELECT 
					CONCAT(TSponsors.strFirstName, ' ', TSponsors.strLastName) AS SponsorName
					, CONCAT(TGolfers.strFirstName, ' ', TGolfers.strLastName) AS GolferName
					, TEventGolferSponsors.decPledgePerHole AS Pledge

				FROM TSponsors 
					JOIN TEventGolferSponsors ON TEventGolferSponsors.IntSponsorID = TSponsors.intSponsorID
					JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferSponsors.intEventGolferID
					JOIN TGolfers ON TGolfers.intGolferID = TEventGolfers.intGolferID
                    JOIN TEvents ON TEvents.intEventID = TEventGolfers.intEventID
                WHERE TEvents.intEventYear = (SELECT MAX(intEventYear) AS CurrentEvent FROM TEvents)
				GROUP BY SponsorName, GolferName, Pledge
				ORDER BY TSponsors.intSponsorID DESC
				Limit 3;";
			echo "<td>";
				if ($result = mysqli_query($link, $recentPledge)){
					if(mysqli_num_rows($result) > 0){
						echo "<table border=1>";
						echo "<tr>";
							echo "<th>Sponsor Name</th>";
							echo "<th>Golfer Name</th>";
							echo "<th>Amount:</th>";
						echo "</tr>";
					//$counter = 1;
					while($row = mysqli_fetch_array($result)){
						echo "<tr>";
							echo "<td>" . $row['SponsorName'] . "</td>";
							echo "<td>" . $row['GolferName'] . "</td>";
							echo "<td> $" . number_format($row['Pledge']) . "</td>";
						echo "</tr>";
		
					}
				 }
				}
			echo "</td>";
			?>

		</tr>
    </table>
</body>
</html>