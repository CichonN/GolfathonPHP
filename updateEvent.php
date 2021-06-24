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

<h2>Update Event</h2>
		<form action="EventUpdate.php" method="post">
		
			<?php
				//Connect to MySQL
				$servername = "itd2.cincinnatistate.edu";
				$username = "ncichon";
				$password = "0680010";
				$dbname = "WAPP1CichonN";
				
				//Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				
				//Check connection
				if (!$conn) 
				{
					die("Connection failed: " . mysqli_connect_error());
				}
				if (isset($_GET['intEventID']))
				{
					$intEventID = $_GET['intEventID'];
				}
					$resultSet = $conn->query("
						SELECT intEventYear
						FROM TEvents
						WHERE TEvents.intEventID = " .$intEventID );
				
						$row = mysqli_fetch_array($result);			
					while($rows = $resultSet->fetch_assoc())
					{
						$intEventYear = $rows['intEventYear'];

					}
					
?>

		<input type=hidden name=intEventID value=<?php echo $intEventID; ?>>
	
			<table border="1" align=center>
				<tbody>
					<tr>
						<td>
							<label for="txtEvent">Event Year:*</label>
						</td>
						<td>
						<?php
							echo '<input type="text" name="txtEvent" value="'.$intEventYear. '" size="20" maxlength="4" required>'; ?>
						</td>
					</tr>									
					
					<tr>
						<td colspan="3" style="text-align:center">
							<input type="submit" value="Submit" style="width: 100px"> 
							<input type="reset" value="Reset" style="width: 100px">
						</td>
					</tr>
</form>

</body>
</html>