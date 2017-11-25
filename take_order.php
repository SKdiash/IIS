<?php
    require_once("header.php");
?>
<div class="block_for_messages">
    <?php
      
        // pokud jsou nejake chyby - vypise se jake
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];

            // Smazani chyb pri aktualizace stranky
            unset($_SESSION["error_messages"]);
        }
        // pokud jsou nejake zpravy - vypise se jake
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];

            // Smazani zprav pri aktualizace stranky
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>


<?php
    require_once("person_area.php");
?>

<?php

echo '<table border="1" cellpadding="7" cellspacing="2" summary="Objednávky" id="Table4">
   <tbody>
      <tr>
         <th colspan="7" scope="colgroup">Objednávky</th>
      </tr>
      <tr>
      	 <th scope="col" abbr="User">Firma</th>
         <th scope="col" abbr="Name">Kurz</th>
         <th scope="col" abbr="Tutor">Město</th>
         <th scope="col">Datum</th>
         <th scope="col">Stav</th>
         <th colspan="2" scope="col">Odmítnout/Přijmout</th>
      </tr>';
      
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';

    // Abychom dozvedeli kdo je uzivatel, potrebujeme to pozdeji
   
  
    $list_order = $mysqli->query("SELECT * FROM `order`"); // zjistime kolik objednavek
    //echo $list_course->num_rows;
    
    for($i = 1; $i <= ($list_order->num_rows); $i++)
    {  

		$order_on = $list_order->fetch_assoc();
		$result_firm = $mysqli->query("SELECT email FROM `users` WHERE id = '".$order_on['id_firm']."'");

		$email= $result_firm->fetch_assoc();

		$resC = $mysqli->query("SELECT name FROM `course` WHERE id_course = '".$order_on['id_course']."'");

		 $id_course = $resC->fetch_assoc();


		echo '<tr>
				<td scope="row">'.$email['email'].'</td>
		    <td>'.$id_course['name'].'</td>
		    <td>'.$order_on['city'].'</td>
		    <td>'.$order_on['dates'].'</td>';
    if($order_on['accept'] == 0)
       echo '<td>Čeká</td>';
    elseif ($order_on['accept'] == 1)
       echo '<td>Přijata</td>';
    else 
       echo '<td>Odmítnuta</td>';

   // if($order_on['accept'] == 0) //jen jedna možnost odmítnout nebo prijmout
      echo '<td>
          <form action="refuse_order.php" method="post" name="refuse_order">
              <input type="hidden"  name="refuse" value="'.$order_on['id'].'"" />
              <input type="submit" name="btn_submit_refuse_order" value="Odmítnout" />
            </form>
            </td>
            <td>

             <form action="accept_order.php" method="post" name="accept_order">
              <input type="hidden"  name="accept" value="'.$order_on['id'].'"" />
              <input type="submit" name="btn_submit_accept_order" value="Přijmout" />
            </form>
            </td>';

		echo '</tr>';       
    }
    // pro uzivatele bych dala nejaky select from course where course.id = listed_course.id_course and listed_course.number_logged < course.max_cap

?>

<?php
    require_once("footer.php");
?>