<?php  
	session_start();
 
if (isset($_POST['username'])) {
        include_once("db-connect.php");
               
            if ($dbConnect->connect_error) {
                die('Connect Error (' . $dbConnect->connect_errno . ') ' . $dbConnect->connect_error);
            }
   
        $user = strip_tags($_POST['username']);
        $pass = strip_tags($_POST['password']);
 
        $user = mysqli_real_escape_string($dbConnect, $user);
        $pass = mysqli_real_escape_string($dbConnect, $pass);
 
        $sql = "SELECT user_id, username, password, name, lastname FROM users WHERE username = '$user' LIMIT 1";
        $query = mysqli_query($dbConnect, $sql);

        	if(!$query) {
                        die($dbConnect->error);
                }
        $row = mysqli_fetch_row($query);
 
        $dbUid  = $row[0];
        $dbUser = $row[1];
        $dbPass = $row[2];
        $dbName = $row[3];
        $dbLast = $row[4];
 
        // Check if the username and the password they entered was correct
        if ($user == $dbUser && $pass == $dbPass) {
                // Set session
                $_SESSION['username'] = $user;
                $_SESSION['id'] = $dbUid;
                // Now direct to users feed
                header("Location: http://hatatorpet.se/start.php");
				die();
        } else {
                echo "<h2>Fel användarnamn eller lösenord!
                <br /> Försök igen.</h2>";
        }
       
}
?>
	
<!doctype html>
<html lang="en">
<head>
	<meta name="description" content="Österängs hemsida">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>hata torpet</title>

	<!-- LOAD STYLESHEETS -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/stylesheet.css">

	<!-- LOAD JAVASCRIPTS -->
	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/fluxslider.js"></script>
	<script src="js/main.js"></script>

	<script>
	</script>

	</head>
<body>
	<div class="wrapper">
		<div class="header">
			<h1>Välkommen till Österäng</h1>
			<div class="slide" id="slider">
				<img src="img/1.png" alt="slideshowen" id="slideshow">
			</div>
		</div>
		<div class="login">
			<h2>Logga in or be a torpare</h2>
			<form action="startpage.php" method="POST" enctype="multipart/form-data">
				Användare <input type="text" name="username" placeholder="Användare">
				Lösenord <input type="password" name="password" placeholder="Lösenord">
				<button type='submit' name='submit'>Logga in</button>
  				<button type="button" onclick="regi()">Registrera dig</button>
			</form>
		</div>
		<div class="register" id="register">		
		<h2>Registrera dig</h2>
		<img src="img/logo.png" alt="logga" class="logo">	
			<form action="register.php" method="POST" enctype="multipart/form-data">			
				Förnamn <input type="text" name="firstnameReg" placeholder="Förnamn">
				Efternamn <input type="text" name="lastnameReg" placeholder="Efternamn"><br/>
				Klass 	<select>
							<option disabled selected></option>
							<option value="te1a" name="te1a">Te1a</option>
							<option value="na1a" name="na1a">Na1a</option>
							<option value="te2a" name="te2a">Te2a</option>
							<option value="na2a" name="na2a">Na2a</option>
							<option value="te3a" name="te3a">Te3a</option>
							<option value="na3a" name="na3a">Na3a</option>
						</select>
						<br/>
				Användare <input type="text" name="usernameReg" placeholder="Användare">
				<br/>
				Email<br/> <input type="email" name="emailReg" placeholder="dinmail@hemsida.com">
				Lösenord <input type="password" name="passwordReg" id="password1" placeholder="Lösenord" onchange="validate()">
				Lösenord igen <input type="password" name="passwordReg" id="password2" onchange="validate()" placeholder="Lösenord">
				<img id="status" alt="valid" src="img/check.png"></img>
				<button type='submit' name='register'>Registrera</button>
			</form>
		</div>
	</div>
</body>
</html>