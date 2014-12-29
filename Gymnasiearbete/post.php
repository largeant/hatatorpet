<?php 
session_start();

if (isset($_SESSION['id'])) {
	// Put stored session variables into local PHP variable
	$uid = $_SESSION['id'];
	$usname = $_SESSION['username'];
	$result = "Du skriver som ".$usname."#".$uid."<div class='center'>
	<form action='index.php' method='post' class='new-post'>
		<h3>Rubrik</h3>
		<input type='text' name='header' class='header-post' placeholder='rubrik'>
		<h3>Innehåll</h3>
		<textarea name='content' id='new-post-content' placeholder='innehåll' name='content'></textarea>
		<input type='Submit' class='btn-post'>
	</form>
</div>
<a href='logout.php'>Click here to log out</a>";
 
	if (isset($_POST['header'], $_POST['content'])) {

		include_once('db-connect.php');

		if ($dbConnect->connect_error) {
            die('Connect Error (' . $dbConnect->connect_errno . ') ' . $dbConnect->connect_error);
        }

		$header = strip_tags($_POST['header']);
		$content = strip_tags($_POST['content']);

		$insertSql = "	INSERT INTO posts (author, header, content, time)
						VALUES ('$uid', '$header', '$content', now() )";
		$query = mysqli_query($dbConnect, $insertSql);				
	}										
} else{
		$result = "You are not logged in yet <a href='index.php'>Logga in</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<title>Skapa ett nytt inlägg</title>
</head>
 
<body>
<?php
echo $result;
?>


<style>
	.center{
		background: #CFDBE7;
		border-radius: 5px;
		width: 500px;
		height: 300px;
		margin: auto;
	}
	form .new-post{
		margin: auto;
		width: 300px;
		height: 200px;
	}
	h3{
		margin: 0;
		padding: 0;
		font-family: 'Roboto', sans-serif;
		font-weight: 400;
		line-height: 40px;
		font-size: 1.6em;
		color: white;
		text-align: left;
		float: left;
		margin-left: 20px;
	}
	h3:nth-of-type(1){
		margin-top: 10px;
	}
	.header-post{
		line-height: 30px;
		width: 60%;
		font-size: 30px;
		padding: 5px 0;
		font-size: 1.3em;
		font-weight: 300;
		margin: 10px 0 0 27px;
		border: none;
		-moz-box-shadow:    inset 0 0 5px #000000;
   		-webkit-box-shadow: inset 0 0 5px #000000;
   		box-shadow:         inset 0 0 5px #000000;
	}
	textarea{
		width: 60%;
		resize: none;
		line-height: 30px;
		height: 75%;
		font-size: 1.4em;
		margin: 10px 0 0 10px;
		border: none;
		-moz-box-shadow:    inset 0 0 5px #000000;
   		-webkit-box-shadow: inset 0 0 5px #000000;
   		box-shadow:         inset 0 0 5px #000000;
	}
	.btn-post{
		width: 70px;
		height: 40px;
		margin-right: 4px;
		float: right;
		background: white;
		border: none;
		margin-top: 194px;
		letter-spacing: 2px;
		font-size: 1em;
	}
</style>


</body>
</html>