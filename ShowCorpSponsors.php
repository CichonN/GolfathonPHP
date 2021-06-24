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

<h2>Corporate Sponsors</h2>		

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
	$intCorporateSponsorID = $_GET["intCorporateSponsorID"];
	$txtFirstName = $_POST["txtFirstName"];
	$txtLastName = $_POST["txtLastName"];
	$txtAddress = $_POST["txtAddress"];
	$txtCity = $_POST["txtCity"];
	$txtZip = $_POST["txtZip"];
	$txtPhone = $_POST["txtPhone"];
	$txtEmail = $_POST["txtEmail"];
	$selState = $_POST["selState"];



	//Display all golfers
	$sql = "
		SELECT 
		TCorporateSponsors.intCorporateSponsorID
		, TCorporateSponsors.strFirstName
		, TCorporateSponsors.strLastName
		, TCorporateSponsors.strAddress
		, TCorporateSponsors.strCity
		, TCorporateSponsors.strZipCode
		, TCorporateSponsors.strPhoneNumber
		, TCorporateSponsors.strEmail
		, TStates.strState

		FROM TCorporateSponsors 
			JOIN TStates ON TCorporateSponsors.intStateID = TStates.intStateID
			
		ORDER BY TCorporateSponsors.intCorporateSponsorID";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=1 align=center>";
			echo "<tr>";
				echo "<th>Update Sponsor</th>";
				echo "<th>First Name</th>";
				echo "<th>Last Name</th>";
				echo "<th>Address</th>";
				echo "<th>City</th>";
				echo "<th>State</th>";
				echo "<th>Zip Code</th>";
				echo "<th>Phone Number</th>";
				echo "<th>Email</th>";

            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            ?>       
			<tr>  
				 <td style="text-align:center"> <a href = "updateCorpSponsor.php?intCorporateSponsorID=<?php echo $row['intCorporateSponsorID']?>">Update</a> </td> <?php
                echo "<td>" . $row['strFirstName'] . "</td>";
                echo "<td>" . $row['strLastName'] . "</td>";
                echo "<td>" . $row['strAddress'] . "</td>";
				echo "<td>" . $row['strCity'] . "</td>";
				echo "<td>" . $row['strState'] . "</td>";
				echo "<td>" . $row['strZipCode'] . "</td>";
				echo "<td>" . $row['strPhoneNumber'] . "</td>";
				echo "<td>" . $row['strEmail'] . "</td>";

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
         echo "<p style='text-align:center'>No records matching your query were found.</p>";
    }
} else{
    echo "ERROR: $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>
	<br>
	<button style="display: block; margin: auto;"r onclick="location.href = '/WAPP1-CichonN/Content/Week13/AddCorporateSponsor.php';">Add Corporate Sponsor</button></a>

	</body>
</html>