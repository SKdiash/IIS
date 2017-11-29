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


echo '<h2>Seznam objednávek</h2>
      <table border="1" cellpadding="5" cellspacing="2" summary="Objednávky" id="Table4">
      <tbody>
      <tr>
         <th colspan="5" scope="colgroup">Objednávky</th>
      </tr>
      <tr>
         <th scope="col" abbr="Name">Kurz</th>
         <th scope="col" abbr="Tutor">Město</th>
         <th scope="col">Datum</th>
         <th scope="col">Stav</th>
         <th scope="col">Zrušit</th>

      </tr>';
      
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';

    // Abychom dozvedeli kdo je uzivatel, potrebujeme to pozdeji
   
    $email = $_SESSION['email'];
    $result = $mysqli->query("SELECT id FROM `users` WHERE email = '".$email."'");
    $user = $result->fetch_assoc();
      
  
    $list_order = $mysqli->query("SELECT * FROM `order` WHERE id_firm = '".$user['id']."'"); // zjistime kolik ted probiha kurzu
    //echo $list_course->num_rows;
    
    for($i = 1; $i <= ($list_order->num_rows); $i++)
    {  
        $order_on = $list_order->fetch_assoc();
        $resC = $mysqli->query("SELECT name FROM `course` WHERE id_course = '".$order_on['id_course']."'");
        $id_course = $resC->fetch_assoc();
        
        echo '<tr>
              <td scope="row">'.$id_course['name'].'</td>
              <td>'.$order_on['city'].'</td>
              <td>'.$order_on['dates'].'</td>';

        if($order_on['accept'] == 0)
            echo '<td>Čeká</td>';
        elseif ($order_on['accept'] == 1)
            echo '<td>Přijata</td>';
        else 
            echo '<td>Odmítnuta</td>';

        if($order_on['accept'] == 0) //jen pokud se ceka
        echo '<td>
              <form action="delete_order.php" method="post" name="delete_order">
                <input type="hidden"  name="del" value="'.$order_on['id'].'"" />
                <input type="submit" name="btn_submit_delete_order" value="Smazat" />
              </form>
              </td>';
        echo '</tr>';  
    }
?>

<?php
    require_once("footer.php");
?>