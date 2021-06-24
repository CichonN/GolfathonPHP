
<html>
<body>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/Style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php
    session_start();
    if(isset($_SESSION['login'])) {
		?>
        <button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Admin.php';"><i class="fa fa-home"></i> Admin Home</button> <?php
    }else{
	?>
	
	<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Home.php';"><i class="fa fa-home"></i> Home</button></a>
	<?php } ?>

<h2>Golfer Details</h2>		

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
	$intGolferID = $_GET["intGolferID"];
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
	$str = "intGolferID = {$intGolferID}";
	$queryStrURL = "www.updateplayer.php?$str";


	//Display all golfers
	$sql = "
SELECT 
TGolfers.intGolferID
, TGolfers.strFirstName
, TGolfers.strLastName
, TGolfers.strAddress
, TGolfers.strCity
, TGolfers.strZipCode
, TGolfers.strPhoneNumber
, TGolfers.strEmail
, TStates.strState
, TGenders.strGender
, TShirtSizes.strShirtSize
, TEventGolfers.intEventGolferID
, CONCAT(TTypesOfTeams.strTypeOfTeam, TLevelOfTeams.strLevelOfTeam, TGenders.strGender) AS Team
FROM TGolfers 
	JOIN TStates ON TGolfers.intStateID = TStates.intStateID
	JOIN TGenders ON TGolfers.intGenderID = TGenders.intGenderID
	JOIN TShirtSizes ON TGolfers.intShirtSizeID = TShirtSizes.intShirtSizeID
    LEFT JOIN TEventGolfers ON TEventGolfers.intGolferID = TGolfers.intGolferID
	LEFT JOIN TEvents ON TEvents.intEventID = TEventGolfers.intEventID
    LEFT JOIN TEventGolferTeamAndClubs ON TEventGolferTeamAndClubs.intEventGolferID = TEventGolfers.intEventGolferID
    LEFT JOIN TTeamsAndClubs ON TTeamsAndClubs.intTeamsAndClubID = TEventGolferTeamAndClubs.intTeamsAndClubID
    LEFT JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID 
	LEFT JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID 
WHERE TEvents.intEventID = (SELECT intEventID FROM TEvents WHERE intEventYear = (SELECT MAX(intEventYear) FROM TEvents))    
	
ORDER BY TGolfers.intGolferID";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=1 align=center>";
			echo "<tr>";
				echo "<th>Update Player</th>";
				echo "<th>First Name</th>";
				echo "<th>Last Name</th>";
				echo "<th>Address</th>";
				echo "<th>City</th>";
				echo "<th>State</th>";
				echo "<th>Zip Code</th>";
				echo "<th>Phone Number</th>";
				echo "<th>Email</th>";
				echo "<th>Shirt Size</th>";
				echo "<th>Gender</th>";
				echo "<th>Team</th>";
				echo "<th>Donate</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            ?>       
			<tr>  
				 <td style="text-align:center"> <a href = "updateplayer.php?intGolferID=<?php echo $row['intGolferID']?>&intEventGolferID=<?php echo $row['intEventGolferID']?>">Update</a> </td> <?php
				//echo "<td>" . $row['intGolferID'] . "</td>";
                echo "<td>" . $row['strFirstName'] . "</td>";
                echo "<td>" . $row['strLastName'] . "</td>";
                echo "<td>" . $row['strAddress'] . "</td>";
				echo "<td>" . $row['strCity'] . "</td>";
				echo "<td>" . $row['strState'] . "</td>";
				echo "<td>" . $row['strZipCode'] . "</td>";
				echo "<td>" . $row['strPhoneNumber'] . "</td>";
				echo "<td>" . $row['strEmail'] . "</td>";
				echo "<td>" . $row['strShirtSize'] . "</td>";
				echo "<td>" . $row['strGender'] . "</td>"; 
				echo "<td>" . $row['Team'] . "</td>";
				?>
				<td> <a href = "AddSponsor.php?intGolferID=<?php echo $row['intGolferID']?>"> Donate Now </a> </td> <?php
        }
		echo "</table>";

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
	<br>
	<button style="display: block; margin: auto;"r onclick="location.href = '/WAPP1-CichonN/Content/Week13/AddGolfer.php';">Add Golfer</button></a>

	</body>
</html>