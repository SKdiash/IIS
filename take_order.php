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
//tisknuti tabulky pro objednavky
echo '<h2>Objednávky</h2>
    <table border="1" cellpadding="7" cellspacing="2" summary="Objednávky" id="Table4">
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
    
    $list_order = $mysqli->query("SELECT * FROM `order`"); // zjistime kolik objednavek
    
    for($i = 1; $i <= ($list_order->num_rows); $i++)
    {  
        //tisteni informace o objednavce a zakaznikovi od ktereho je
        $order_on = $list_order->fetch_assoc();
        $result_firm = $mysqli->query("SELECT email FROM `users` WHERE id = '".$order_on['id_firm']."'");
        $email= $result_firm->fetch_assoc();
        //jmeno objednavaneho kurzu
        $resC = $mysqli->query("SELECT name FROM `course` WHERE id_course = '".$order_on['id_course']."'");
        $id_course = $resC->fetch_assoc();
        //info o objednavce
        echo '<tr>
        		<td scope="row">'.$email['email'].'</td>
            <td>'.$id_course['name'].'</td>
            <td>'.$order_on['city'].'</td>
            <td>'.$order_on['dates'].'</td>';
        if($order_on['accept'] == 0)//objednavka ceka
           echo '<td>Čeká</td>';
        elseif ($order_on['accept'] == 1)//je prijata
           echo '<td>Přijata</td>';
        else 
           echo '<td>Odmítnuta</td>';//je odmitnuta
         //tlacitka odmitnout prijmout
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
?>

<?php
    require_once("footer.php");
?>