<?php
session_start();
 
if (isset($_POST['username'])) {
        include_once("db-connect.php");
               
                if ($dbConnect->connect_error) {
                        die('Connect Error (' . $dbConnect->connect_errno . ') ' . $dbConnect->connect_error);
                }
   
        $usname = strip_tags($_POST['username']);
        $paswd = strip_tags($_POST['password']);
 
        $usname = mysqli_real_escape_string($dbConnect, $usname);
        $paswd = mysqli_real_escape_string($dbConnect, $paswd);
 
        $sql = "SELECT user_id, username, password FROM users WHERE username = '$usname' LIMIT 1";
        $query = mysqli_query($dbConnect, $sql);

        	if(!$query) {
                        die($dbConnect->error);
                }
        $row = mysqli_fetch_row($query);
 
        $uid = $row[0];
        $dbUsname = $row[1];
        $dbPassword = $row[2];
 
        // Check if the username and the password they entered was correct
        if ($usname == $dbUsname && $paswd == $dbPassword) {
                // Set session
                $_SESSION['username'] = $usname;
                $_SESSION['id'] = $uid;
                // Now direct to users feed
                header("Location: user.php");
        } else {
                echo "<h2>Oops that username or password combination was incorrect.
                <br /> Please try again.</h2>";
        }
       
}
if (isset($_POST['userReg'])){
	include_once('db-connect.php');

		if ($dbConnect->connect_error) {
            die('Connect Error (' . $dbConnect->connect_errno . ') ' . $dbConnect->connect_error);
        }

	$userReg = strip_tags($_POST['userReg']);
	$passReg = strip_tags($_POST['passReg']);
	$firstnameReg = strip_tags($_POST['firstnameReg']);
	$lastnameReg = strip_tags($_POST['lastnameReg']);
	$emailReg = strip_tags($_POST['emailReg']);

	$insertSql = "INSERT INTO users (username, password, first_name, last_name, email)
						VALUES ('$userReg', '$passReg', '$firstnameReg', '$lastnameReg', '$emailReg')";

	if ($dbConnect->query($insertSql) === TRUE) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $insertSql . "<br>" . $dbConnect->error;
	}

$dbConnect->close();
}
?>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
<style>
	*{
		margin: 0;
		padding: 0;
		font-family: 'Roboto', sans-serif;
	}
</style>
<h1>Simple Login</h1>
<form id="form" action="index.php" method="post" enctype="multipart/form-data">
Username: <input type="text" name="username" /> <br />
Password: <input type="password" name="password" /> <br />
<input type="submit" value="Login" name="Submit" />
</form>
<h1>Simple Register</h1>
<form action="index.php" method="post" id="register">
	Username: <input type="text" name="userReg"><br />
	First name: <input type="text" name="firstnameReg"><br />
	Last name: <input type="text" name="lastnameReg"><br />
	E-mail: <input type="text" name="emailReg"><br />
	Password: <input type="password" name="passReg"><br />
	<input type="submit" name="Submit" value="Register">
</form>