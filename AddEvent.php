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

<h2>Add Event</h2>
		<form action="EventInsert.php" method="post">
			<table border="1" align=center>
				<tbody>
					<tr>
						<td>
							<label for="txtEvent">Event Year:*</label>
						</td>
						<td>
							<input type="number" name="txtEvent" value="" size="20" maxlength="4" required>
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