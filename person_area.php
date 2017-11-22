
<?php
/* TODO */
/* ABY PO ODHLASOVANI UZIVATELU "PRESTEHOVAL" DO HLAVNI STRANKY  */

?>

<?php
    require_once("header.php");
?>

<?php
      require_once("dbconnect.php");
      // pomocna promenna pro zjisteni uziateli
      $email = $_SESSION['email'];
      $result = $mysqli->query("SELECT firm FROM `users` WHERE email = '".$email."'");
      // dostaneme cislicovy identifikato uzivateli
      $row = $result->fetch_assoc();
      /*if ($row = $result->fetch_assoc())   // for debugging reason just to ckeck if 
      {                                      // it works
        echo $row['firm'];
      } */
?>

<div id="person_block">
<?php // admin firm=3     
      if($row['firm'] == 3){  
?>
      <div id="person_info">
          <a href="person_info.php">Osobne udaji</a>
      </div>
      <div id="course_on">
          <a href="course_on.php">Seznam probihajici kurzu</a>
      </div>
      <div id="course_new">
          <a href="course_new.php">Vytvoreni noveho kurzu</a>
      </div>
      <div id="take_order">
          <a href="take_order.php">Objednavky</a>
      </div>
      <div id="economic">
          <a href="economic.php">Ekonomicka stranka</a>
      </div>
      <div id="administration">
          <a href="administration.php">Administrace</a>
      </div>
      
      
<?php // uzivatel firm=0
      }elseif($row['firm'] == 0) {  
?>
      <div id="person_info">
          <a href="person_info.php">Osobne udaji</a>
      </div>
      <div id="course_on">
          <a href="course_on.php">Seznam probihajici kurzu</a>
      </div>
      
      
<?php // firma firm=1   
      }elseif($row['firm'] == 1){  
?>    
      <div id="person_info">
          <a href="person_info.php">Osobne udaji</a>
      </div>
      <div id="course_on.php">
          <a href="course_on.php">Seznam probihajici kurzu</a>
      </div>
      <div id="look_order">
          <a href="look_order.php">Seznam objednavek</a>
      </div>
      <div id="make_order">
          <a href="make_order.php">Vytvorit objednavku</a>
      </div>

<?php   
      }
?>
</div>

<?php
    require_once("footer.php");
?>
