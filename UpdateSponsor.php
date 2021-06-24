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




<h2>Update Sponsors</h2>
		<form action="SponsorUpdate.php" method="post">
		
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
				if (isset($_GET['intSponsorID']))
				{
					$intSponsorID = $_GET['intSponsorID'];
				}
					$resultSet = $conn->query("
						SELECT 
							TSponsors.intSponsorID
							, TSponsors.strFirstName
							, TSponsors.strLastName
							, TSponsors.strAddress
							, TSponsors.strCity
							, TSponsors.strZipCode
							, TSponsors.strPhoneNumber
							, TSponsors.strEmail
							, TStates.strState


							
						FROM TSponsors 
							JOIN TStates ON TSponsors.intStateID = TStates.intStateID

							
						WHERE TSponsors.intSponsorID = " .$intSponsorID );
				
						$row = mysqli_fetch_array($result);			
					while($rows = $resultSet->fetch_assoc())
					{
						$strFirstName = $rows['strFirstName'];
						$strLastName = $rows['strLastName'];
						$strAddress = $rows['strAddress'];
						$strCity = $rows['strCity'];
						$strState = $rows['strState'];
						$strZipCode = $rows['strZipCode'];
						$strEmail = $rows['strEmail'];
						$strPhoneNumber = $rows['strPhoneNumber'];
					}
					
?>

		<input type=hidden name=intSponsorID value=<?php echo $intSponsorID; ?>>
	
			<table border="1" align=center>
				<tbody>
					<tr>
						<td>
							<label for="txtFirstName">First Name:*</label>
						</td>
						<td>
						<?php
							echo '<input type="text" name="txtFirstName" value="'.$strFirstName. '" size="20" maxlength="50" required>'; ?>
						</td>
					</tr>									
					<tr>
						<td>
							<label for="txtLastName">Last Name:*</label>
						</td>
						<td>
						<?php
							echo '<input type="text" name="txtLastName" value="'.$strLastName. '" size="20" maxlength="50" required>'; ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtAddress">Address:*</label>
						</td>
						<td>
						<?php
							echo '<input type="text" name="txtAddress" value="'.$strAddress. '" size="20" maxlength="50" required>'; ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtCity">City:*</label>
						</td>
						<td>
						<?php
							echo '<input type="text" name="txtCity" value="'.$strCity. '" size="20" maxlength="50" required>'; ?>
						</td>
					</tr>
					<tr>						
						<td>
							<label for="selState">State:*</label>
						</td>
						<td>
							<?php

								$resultSet = $conn->query("SELECT intStateID, strState FROM TStates");
							?>						
							<select name = "selState">
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$strStateRows = $rows['strState'];
										if($strState == $strStateRows)
										{
											echo "<option value='" . $rows['intStateID'] ."' selected required>" . $rows['strState'] ."</option>";
										}
										else
										{
											echo "<option value='" . $rows['intStateID'] ."' required>" . $rows['strState'] ."</option>";
										}
										
									}
									
								?>
							</select><br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtZip">Zip Code:*</label>
						</td>
						<td>
						<?php
							echo '<input type="number" name="txtZip" value="'.$strZipCode. '" size="20" maxlength="5" required>'; ?>
							
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtPhone">Phone Number:*</label>
						</td>
						<td>
						<?php
							echo '<input type="number" name="txtPhone" value="'.$strPhoneNumber. '" size="20" maxlength="10" required>'; ?>
							
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtEmail">Email:</label>
						</td>
						<td>
						<?php
							echo '<input type="email" name="txtEmail" value="'.$strEmail. '" size="20" maxlength="50" required>'; ?>
							
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