<?php
    session_start();
    echo isset($_SESSION['login']);
    if(isset($_SESSION['login'])) {
      header("Location: /WAPP1-CichonN/Content/Week13/admin.php"); die();
    }
?>


<!DOCTYPE html>
<html>
   <head>
     <meta http-equiv='content-type' content='text/html;charset=utf-8' />
     <title>Login</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="/WAPP1-CichonN/Content/Week13/LoginStyle.css">
   </head>
<body>

<h2>Login Form</h2>

<form action="ProcessLogin.php?" method="post">

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit">Login</button>
	<button type="button" class="cancelbtn" onclick="location.href = '/WAPP1-CichonN/Content/Week13/Home.php';">Cancel</button>
  </div>

</form>

</body>
</html>
