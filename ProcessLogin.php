<html>
<body>
<?php

    session_start();
    echo isset($_SESSION['login']);
	    if(isset($_SESSION['login'])) {
        header('Location: /WAPP1-CichonN/Content/Week13/Admin.php'); die();
    }

?>
	<link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/LoginStyle.css">


    <?php
		//Connect to MySQL
		$servername = "itd2.cincinnatistate.edu";
		$username = "ncichon";
		$password = "0680010";
		$dbname = "WAPP1CichonN";
		
		//Create connection
		$link = mysqli_connect($servername, $username, $password, $dbname);
		
		//Check connection
		if (!$link) {
			die("Connection failed: " . mysqli_connect_error());
			}

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
      
		$CheckPassword = "SELECT * FROM Login WHERE Username = '$username' AND Password = '$password'";
		
		$result = mysqli_query($link, $CheckPassword);
		
		if(!$result || mysqli_num_rows($result) <= 0)
		{
			echo "Username or password is not valid";
			?><br><br><button onclick="location.href = '/WAPP1-CichonN/Content/Week13/Login.php';"><i class="fa fa-user"></i> Try Logging in Again</button></a><?php
			return false;
		}
		else{	
			$_SESSION['login'] = true;
			header("Location: /WAPP1-CichonN/Content/Week13/Admin.php ");
			return true;
		}

      
    ?>


</body>
</html>