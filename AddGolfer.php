
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

<h2>Add New Golfer</h2>
		<form action="GolferInsert.php" method="post">
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
							<select name = "selState" required>
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
							<label for="selShirtSize">Shirt Size:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT intShirtSizeID, strShirtSize FROM TShirtSizes");
							?>						
							<select name = "selShirtSize" required>
							<?php
								while($rows = $resultSet->fetch_assoc())
								{
									$strShirtSize = $rows['strShirtSize'];
									echo "<option value='" . $rows['intShirtSizeID'] ."'>" . $rows['strShirtSize'] ."</option>";
								}
							?>
							</select><br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label for="selGender">Gender:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT intGenderID, strGender FROM TGenders");
							?>						
							<select name = "selGender" required>
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$strGender = $rows['strGender'];
										echo "<option value='" . $rows['intGenderID'] ."'>" . $rows['strGender'] ."</option>";
									}
									mysqli_close($conn);
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
								$resultSet = $conn->query("SELECT TTeamsAndClubs.intTeamsAndClubID, TTypesOfTeams.strTypeOfTeam, TLevelOfTeams.strLevelOfTeam, TGenders.strGender, CONCAT(TTypesOfTeams.strTypeOfTeam, TLevelOfTeams.strLevelOfTeam, TGenders.strGender) AS Team 
															FROM TTeamsAndClubs 
															JOIN TTypesOfTeams ON TTypesOfTeams.intTypesOfTeamID = TTeamsAndClubs.intTypesOfTeamID 
															JOIN TLevelOfTeams ON TLevelOfTeams.intLevelOfTeamID = TTeamsAndClubs.intLevelOfTeamID 
															JOIN TGenders ON TGenders.intGenderID = TTeamsAndClubs.intGenderID");

							?>						
							<select name = "selTeam" required>
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$strTeam = $rows['Team'];
										echo "<option value='" . $rows['intTeamsAndClubID'] ."'>" . $rows['Team'] ."</option>";
									}
									mysqli_close($conn);
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
</form>

</body>
</html>