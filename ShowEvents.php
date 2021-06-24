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

<h2>Manage Events</h2>		

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

	$intEventID = $_GET["intEventID"];

	//Display all Events
	$sql = "
			SELECT intEventID, intEventYear 
			FROM TEvents
			ORDER BY intEventYear DESC";
			
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=1 align=center>";
			echo "<tr>";
				echo "<th>Event Year</th>";


            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            ?>       
			<tr>  
				 <?php
                echo "<td>" . $row['intEventYear'] . "</td>";


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
	<button style="display: block; margin: auto;"r onclick="location.href = '/WAPP1-CichonN/Content/Week13/AddEvent.php';">Add New Event</button></a>

	</body>
</html>