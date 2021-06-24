<html>

<body>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/Style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Home.php';"><i class="fa fa-home"></i> Home</button></a>


<h2>Donate</h2>

		
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
				if (isset($_GET['intGolferID']))
				{
					$intGolferID = $_GET['intGolferID'];
				}

				$resultSet = $conn->query("SELECT TGolfers.intGolferID, TGolfers.strFirstName, TGolfers.strLastName
											, TGolfers.strAddress, TGolfers.strCity, TGolfers.strZipCode, TGolfers.strPhoneNumber, TGolfers.strEmail
											, TStates.strState, TGenders.strGender, TShirtSizes.strShirtSize
											FROM TGolfers 
												JOIN 
													TStates ON TGolfers.intStateID = TStates.intStateID
												JOIN 
													TGenders ON TGolfers.intGenderID = TGenders.intGenderID
												JOIN
													TShirtSizes ON TGolfers.intShirtSizeID = TShirtSizes.intShirtSizeID
											WHERE TGolfers.intGolferID = " .$intGolferID );
									$row = mysqli_fetch_array($result);			
					while($rows = $resultSet->fetch_assoc())
					{
						$strFirstName = $rows['strFirstName'];
						$strLastName = $rows['strLastName'];
						$strAddress = $rows['strAddress'];
						$strCity = $rows['strCity'];
						$strState = $rows['strState'];
						$strZipCode = $rows['strZipCode'];
						$strGender = $rows['strGender'];
						$strEmail = $rows['strEmail'];
						$strShirtSize = $rows['strShirtSize'];
						$strPhoneNumber = $rows['strPhoneNumber'];

					}
					
?>


		Golfer ID: <?php echo $intGolferID; ?>
		



</body>
</html>