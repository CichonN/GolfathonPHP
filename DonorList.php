<html>

<body>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/Style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Home.php';"><i class="fa fa-home"></i> Home</button></a>


	


		
			<?php
				//Connect to MySQL
				$servername = "itd2.cincinnatistate.edu";
				$username = "ncichon";
				$password = "0680010";
				$dbname = "WAPP1CichonN";
				
				//Create connection
				$link = mysqli_connect($servername, $username, $password, $dbname);
				
				//Check connection
				if (!$link) 
				{
					die("Connection failed: " . mysqli_connect_error());
				}
				if (isset($_GET['intGolferID']))
				{
					$intGolferID = $_GET['intGolferID'];
				}
				
				
$db_selected = mysqli_select_db($link, $dbname);

if (!$db_selected) {
    die('Cannot access' . $dbname . ': ' . mysqli_error($link));
}

	$golferName = "SELECT CONCAT(strFirstName, ' ', strLastName) AS GolferName FROM TGolfers WHERE intGolferID = $intGolferID";
	
if ($result = mysqli_query($link, $golferName)) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
        printf ("<h2>Donor List - %s</h2>", $row["GolferName"]);
    }
	
    /* free result set */
    mysqli_free_result($result);
}
	//echo "Golfer ID: %s", $row['GolferName']; 
	//echo $row['AmountRaised'];
	//Display all golfers
	$sql = "
	SELECT TEventGolferSponsors.IntSponsorID
					 , TSponsors.strFirstName
					 , TSponsors.strLastName 
				FROM TEventGolferSponsors 
					 JOIN TSponsors ON TSponsors.intSponsorID = TEventGolferSponsors.IntSponsorID 
					 JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferSponsors.intEventGolferID 
					 JOIN TGolfers ON TEventGolfers.intGolferID = TGolfers.intGolferID 
					 JOIN TEvents ON TEventGolfers.intEventID = TEvents.intEventID 
				 WHERE TGolfers.intGolferID = $intGolferID";
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=1 align=center>";
			echo "<tr>";
				echo "<th>First Name</th>";
				echo "<th>Last Name</th>";

            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
                   
			echo "<tr>";
                echo "<td>" . $row['strFirstName'] . "</td>";
                echo "<td>" . $row['strLastName'] . "</td>";
			echo "</tr>";
        }
		echo "</table>";

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
	<button style="display: block; margin: auto;"r onclick="location.href = '/WAPP1-CichonN/Content/Week13/GolferStatistics.php';">Go Back</button></a>

	</body>
		



</body>
</html>