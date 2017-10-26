<?php

  $host = "localhost:/var/run/mysql/mysql.sock";
  $user = "xleont01";  //database
  $password = "argoco3j";
  $db = "xleont01";
  $web_home = 'http://www.stud.fit.vutbr.cz/~xleont01/';
  
  $connection = mysql_connect($host, $user, $password);
  if(! $connection) 
    die("Error. Connection to server");
  
  $select = mysql_select_db($db, $connection);
  if (! $select) 
    die("Error. Connection to database");
  
  

?>