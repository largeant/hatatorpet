<?php
       
include_once("db-connect.php");

if ($dbConnect->connect_error) {
                die('Connect Error (' . $dbConnect->connect_errno . ') ' . $dbConnect->connect_error);
            }

$group = 'te3a';

$group = mysqli_real_escape_string($dbConnect, $group);

$sql = "SELECT header FROM posts WHERE kelb = '$group' OR kelb = 'ALL'";
$query = mysqli_query($dbConnect, $sql);

if(!$query) {
            die($dbConnect->error);
        
}
	$row = mysqli_fetch_row($query);
    $dbUid  = $row[0];

    echo "$dbUid";


/*while($row = mysqli_fetch_assoc($query)) {

 $title = $row['title'];
 $content = $row['content'];
 $author = $row['author'];
 $date = $row['date'];
 $group = $row['group'];

 echo "$title<br/>$content<br/>$author<br/>$date<br/>$group";
 echo "poop";

}*/



?>