
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
	<?php } 
		if (isset($_GET['intGolferID']))
		{
			$intGolferID = $_GET['intGolferID'];
		}
	?>

<h2>Add New Sponsor</h2>
		<form action="SponsorInsert.php" method="post">
			<table border="1" align=center>
				<tbody>
					<tr>
						<td>
							<label for="txtFirstName">First Name:*</label>
						</td>
						<td>
							<input type="text" name="txtFirstName" value="" size="20" maxlength="50" required>
						</td>
					</tr>									
					<tr>
						<td>
							<label for="txtLastName">Last Name:*</label>
						</td>
						<td>
							<input type="text" name="txtLastName" value="" size="20" maxlength="50" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtAddress">Address:*</label>
						</td>
						<td>
							<input type="text" name="txtAddress" value="" size="20" maxlength="50" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtCity">City:*</label>
						</td>
						<td>
							<input type="text" name="txtCity" value="" size="20" maxlength="50" required>
						</td>
					</tr>
					<tr>						
						<td>
							<label for="selState">State:*</label>
						</td>
						<td>
							<?php
								//Connect to MySQL
								$servername = "itd2.cincinnatistate.edu";
								$username = "ncichon";
								$password = "0680010";
								$dbname = "WAPP1CichonN";
								
								//Create connection
								$conn = mysqli_connect($servername, $username, $password, $dbname);
								
								//Check connection
								if (!$conn) {
									die("Connection failed: " . mysqli_connect_error());
									}
								$resultSet = $conn->query("SELECT intStateID, strState FROM TStates");
							?>						
							<select name = "selState">
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$strState = $rows['strState'];
										echo "<option value='" . $rows['intStateID'] ."'>" . $rows['strState'] ."</option>";
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
							<input type="number" name="txtZip" value="" size="20" maxlength="5" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtPhone">Phone Number:*</label>
						</td>
						<td>
							<input type="number" name="txtPhone" value="" size="20" maxlength="10" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtEmail">Email:*</label>
						</td>
						<td>
							<input type="email" name="txtEmail" value="" size="20" maxlength="50" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="selGolfer">Golfer:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("
								SELECT TGolfers.intGolferID, CONCAT(TGolfers.strFirstName, ' ', TGolfers.strLastName, ' - ', TTypesOfTeams.strTypeOfTeam, ' ', TLevelOfTeams.strLevelOfTeam, ' ', TGenders.strGender) AS GolferName 
								FROM TGolfers
									JOIN TEventGolfers ON TEventGolfers.intGolferID = TGolfers.intGolferID
									JOIN TEventGolferTeamAndClubs ON TEventGolferTeamAndClubs.intEventGolferID = TEventGolfers.intEventGolferID
									JOIN TTeamsAndClubs ON TTeamsAndClubs.intTeamsAndClubID = TEventGolferTeamAndClubs.intTeamsAndClubID
									JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID
									JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID
									JOIN TGenders ON TGenders.intGenderID = TTeamsAndClubs.intGenderID
								ORDER BY TGolfers.strFirstName");
							?>						
							<select name = "selGolfer">
							<?php
								while($rows = $resultSet->fetch_assoc())
								{
									$strGolfer = $rows['GolferName'];
									
										if($intGolferID == $rows['intGolferID'])
										{
											echo "<option value='" . $rows['intGolferID'] ."' selected required>" . $rows['GolferName'] ."</option>";
										}
										else
										{
											echo "<option value='" . $rows['intGolferID'] ."' required>" . $rows['GolferName'] ."</option>";
										}
									
									
								}
							?>
							</select><br><br>
						</td>
					</tr>
										<tr>
						<td>
							<label for="dtmDateOfPledge">Date of Pledge:*</label>
						</td>
						<td>
							<input type="date" name="dtmDateOfPledge" value="<?php echo date('Y-m-d'); ?>" />
							
						</td>
					</tr>
					<tr>
					<tr>
						<td>
							<label for="txtPledgeAmount">Pledge Amount:*</label>
						</td>
						<td>
							<input type="number" min="0.01" step="0.01" name="txtPledgeAmount" value="" size="20" maxlength="50" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="selPaymentType">Payment Type:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT intPaymentTypeID, strPaymentType FROM TPaymentTypes");
							?>						
							<select name = "selPaymentType">
							<?php
								while($rows = $resultSet->fetch_assoc())
								{
									$strPaymentType = $rows['strPaymentType'];
									echo "<option value='" . $rows['intPaymentTypeID'] ."'>" . $rows['strPaymentType'] ."</option>";
								}
							?>
							</select><br><br>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align:center">
							<input type="submit" value="Submit" style="width: 100px; color:#FFFFFF; background-color:#2E8B57; text-align:center;" > 
							<input type="reset" value="Reset" style="width: 100px; color:#FFFFFF; background-color:#2E8B57; text-align:center;">
						</td>
					</tr>
				</tbody>
			</table>
		</form>

</body>
</html>