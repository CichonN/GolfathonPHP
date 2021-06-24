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

<h2>Add New Corporate Sponsor</h2>
		<form action="CorporateSponsorInsert.php" method="post">
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
							<label for="selSponsorship">Corporate Sponsorship:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT
																intEventCorporateSponsorTypeID
																, CONCAT(
																  'Sponsorship Type: '
																, TCorporateSponsorshipTypes.strCorporateSponsorshipType
																, ', Cost: $'
																, TEventCorporateSponsorshipTypes.decSponsorshipCost
																, ', Qty Available: '
																, TEventCorporateSponsorshipTypes.intSponsorshipAvailable ) AS CorporateSponsorship
																																												
															FROM TCorporateSponsorshipTypes
																JOIN teventcorporatesponsorshiptypes ON teventcorporatesponsorshiptypes.intCorporateSponsorTypeID = TCorporateSponsorshipTypes.intCorporateSponsorshipTypeID
																JOIN TEvents ON TEvents.intEventID = teventcorporatesponsorshiptypes.intEventID

															WHERE TEventCorporateSponsorshipTypes.intSponsorshipAvailable > 0 AND TEvents.intEventYear = (SELECT MAX(intEventYear) AS CurrentEvent FROM TEvents)");
							?>						
							<select name = "selSponsorship">
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$strCorpSponsorship = $rows['CorporateSponsorship'];
										echo "<option value='" . $rows['intEventCorporateSponsorTypeID'] ."'>" . $rows['CorporateSponsorship'] ."</option>";
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