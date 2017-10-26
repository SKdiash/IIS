<!DOCTYPE HTML>

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <title>Vector</title>
    <link rel="stylesheet" href="css/style.css">
    <?php include_once "connection.php"?>
</head>

<header>
<?php include_once "header.php" ?>
</header>

<body>
    <div class="loginform">
      <form action="login.php" method="post">
      
      <label>Login:</label>     
        <input type="text" name="name" placeholder="Write your login"> 
        <br>
      <label>Password:</label>
        <input type="password" name="password" placeholder="Write your password">     
        <br>
      
      <input type="submit" name="submit" value="Enter">
      <button formaction="registration.php">Registration</button>
      
      </form>
    </div> 
</body>