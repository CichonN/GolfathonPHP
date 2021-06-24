
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

<h2>Update Golfer</h2>
		<form action="GolferUpdate.php" method="post">
		
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
				if (isset($_GET['intEventGolferID']))
				{
					$intEventGolferID = $_GET['intEventGolferID'];
				}
					$resultSet = $conn->query("
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
							, TTypesOfTeams.strTypeOfTeam, TLevelOfTeams.strLevelOfTeam, TGenders.strGender
							, TShirtSizes.strShirtSize
							, (SELECT CONCAT(TTypesOfTeams.strTypeOfTeam, TLevelOfTeams.strLevelOfTeam, TGenders.strGender)  
                               FROM TTeamsAndClubs
                              		JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID
                              		JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID
                              		JOIN TGenders ON TGenders.intGenderID = TTeamsAndClubs.intGenderID
                               		JOIN TEventGolferTeamAndClubs ON TEventGolferTeamAndClubs.intTeamsAndClubID = TTeamsAndClubs.intTeamsAndClubID
                               		JOIN TEventGolfers ON TEventGolfers.intEventGolferID = TEventGolferTeamAndClubs.intEventGolferID
                               		JOIN TGolfers ON TGolfers.intGolferID= TEventGolfers.intGolferID
                              	WHERE TGolfers.intGolferID = '$intGolferID') AS Team
							
						FROM TGolfers 
							JOIN TStates ON TGolfers.intStateID = TStates.intStateID
							JOIN TGenders ON TGolfers.intGenderID = TGenders.intGenderID
							JOIN TShirtSizes ON TGolfers.intShirtSizeID = TShirtSizes.intShirtSizeID
							LEFT JOIN TEventGolfers ON TEventGolfers.intGolferID = TGolfers.intGolferID
							LEFT JOIN TEventGolferTeamAndClubs ON TEventGolferTeamAndClubs.intEventGolferID = TEventGolfers.intEventGolferID
							LEFT JOIN TTeamsAndClubs ON TTeamsAndClubs.intTeamsAndClubID = TEventGolferTeamAndClubs.intTeamsAndClubID
							LEFT JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID 
							LEFT JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID 
							
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
						$strTeam = $rows['Team'];
					}
					
?>

		<input type=hidden name=intGolferID value=<?php echo $intGolferID; ?>>
		<input type=hidden name=intEventGolferID value=<?php echo $intEventGolferID; ?>>
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
						<td>
							<label for="selShirtSize">Shirt Size:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT intShirtSizeID, strShirtSize FROM TShirtSizes");
							?>						
							<select name = "selShirtSize">
							<?php
								while($rows = $resultSet->fetch_assoc())
								{
									$strShirtSizeRows = $rows['strShirtSize'];
										if($strShirtSize == $strShirtSizeRows)
										{
											echo "<option value='" . $rows['intShirtSizeID'] ."' selected required>" . $rows['strShirtSize'] ."</option>";
										}
										else
										{
											echo "<option value='" . $rows['intShirtSizeID'] ."' required>" . $rows['strShirtSize'] ."</option>";
										}
									
								}
							?>
							</select><br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label for="selGender">Gender:</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT intGenderID, strGender FROM TGenders");
							?>						
							<select name = "selGender">
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$strGenderRows = $rows['strGender'];
										
										
										if($strGender == $strGenderRows)
										{
											echo "<option value='" . $rows['intGenderID'] ."' selected required>" . $rows['strGender'] ."</option>";
										}
										else
										{
											echo "<option value='" . $rows['intGenderID'] ."' required>" . $rows['strGender'] ."</option>";
										}
										
									}
									//mysqli_close($conn);
								?>
							</select><br><br>
						</td>
					</tr>
					
					
					<tr>
						<td>
							<label for="selTeam">Team:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT TTeamsAndClubs.intTeamsAndClubID
																, TTypesOfTeams.strTypeOfTeam
																, TLevelOfTeams.strLevelOfTeam
																, TGenders.strGender
																, CONCAT(TTypesOfTeams.strTypeOfTeam, TLevelOfTeams.strLevelOfTeam, TGenders.strGender) AS Team 
															FROM TTeamsAndClubs 
																JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID 
																JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID 
																JOIN TGenders ON TGenders.intGenderID = TTeamsAndClubs.intGenderID;");
							?>						
							<select name = "selTeam">
							<?php
								while($rows = $resultSet->fetch_assoc())
								{
									$strTeamRows = $rows['Team'];
										if($strTeam == $strTeamRows)
										{
											echo "<option value='" . $rows['intTeamsAndClubID'] ."' selected required>" . $rows['Team'] ."</option>";
										}
										else
										{
											echo "<option value='" . $rows['intTeamsAndClubID'] ."' required>" . $rows['Team'] ."</option>";
										}
									
								}
								mysqli_close($conn);
							?>
							</select><br><br>
						</td>
					</tr>
					
					<tr>
						<td colspan="3" style="text-align:center">
							<input type="submit" value="Submit" style="width: 100px"> 
							<input type="reset" value="Reset" style="width: 100px">
						</td>
					</tr>
					</tbody>
				</table>
</form>

</body>
</html>