<?php
include_once "index.php"

$query = "INSERT INTO users VALUES(0, '".$_POST['login']."','".$_POST['password']."', '"$_POST['name']."', '".$_POST['surname']."', '".$_POST['bithday']."','".$_POST['email']."')";

$result = mysql_query($query, $connection);
if (! $result) 
  die("Error. Registration user.")

  echo $query

?>