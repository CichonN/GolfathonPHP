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

<h2>Add Corporate Sponsorship</h2>
		<form action="CorporateSponsorshipInsert.php" method="post">
			<table border="1" align=center>
				<tbody>
					<tr>						
						<td>
							<label for="selEvent">Event:*</label>
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
								$resultSet = $conn->query("SELECT intEventID, intEventYear FROM TEvents");
							?>						
							<select name = "selEvent">
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$intEventYear = $rows['intEventYear'];
										echo "<option value='" . $rows['intEventID'] ."'>" . $rows['intEventYear'] ."</option>";
									}
								?>
							</select><br><br>
						</td>
					</tr>
					<tr>						
						<td>
							<label for="selCorporateSponsorshipType">Sponsorship Type:*</label>
						</td>
						<td>
							<?php
								$resultSet = $conn->query("SELECT intCorporateSponsorshipTypeID,strCorporateSponsorshipType FROM TCorporateSponsorshipTypes");
							?>						
							<select name = "selCorporateSponsorshipType">
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$strCorporateSponsorshipType = $rows['strCorporateSponsorshipType'];
										echo "<option value='" . $rows['intCorporateSponsorshipTypeID'] ."'>" . $rows['strCorporateSponsorshipType'] ."</option>";
									}
								?>
							</select><br><br>
						</td>
					</tr>
					<tr>
						<td>
							<label for="txtCost">Sponsorship Cost:*</label>
						</td>
						<td>
							<input type="number" min="0.01" step="0.01" name="txtCost" value="" size="20" maxlength="50" required>
						</td>
					</tr>									
					<tr>
						<td>
							<label for="txtSponsorshipsAvailable">Quanity of Sponsorships:*</label>
						</td>
						<td>
							<input type="number" name="txtSponsorshipsAvailable" value="" size="20" maxlength="50" required>
						</td>
					</tr>	
					<tr>						
						<td>
							<label for="chkBenefits">Benefits:</label>
						</td>
						<td>

							<?php
								$resultSet = $conn->query("SELECT intBenefitID, strBenefitDescription FROM TBenefits");
							?>						
							
								<?php
									while($rows = $resultSet->fetch_assoc())
									{
										$chkBenefits = $rows['strBenefitDescription'];
										 echo "<input type='checkbox' name= 'chkBenefits[]' value='{$rows['intBenefitID']}'>" . $rows['strBenefitDescription'] . '</br>';

								
									}
								?>
							<br><br>
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