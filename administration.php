<?php
    require_once("header.php");
?>
<!-- Specialni block na chyby a zpravy -->
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

//tabulka s uzivately
echo '<table border="1" cellpadding="5" cellspacing="2" summary="Uživatelé" id="Table3">
   <tbody>
      <tr>
         <th colspan="5" scope="colgroup">Uživatelé</th>
      </tr>
      <tr>
         <th scope="col" abbr="Name">Jméno</th>
         <th scope="col" abbr="Tutor">Příjmení</th>
         <th scope="col">E-mail</th>
         <th scope="col">Firma</th>
         <th scope="col">Odstranit</th>
      </tr>';
      
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
      
    $list_user = $mysqli->query("SELECT * FROM `users` WHERE users.firm != 3"); //ucastnici nebo firmy
    
    for($i = 1; $i <= ($list_user->num_rows); $i++)
    {  
        $users_on = $list_user->fetch_assoc();
        $result = $mysqli->query("SELECT * FROM `users` WHERE users.id = '".$users_on['id']."'");
        $users_all= $result->fetch_assoc();//vypis vsech uzivatelů
        echo '<tr>
                 <td scope="row">'.$users_all['first_name'].'</td>
                 <td>'.$users_all['last_name'].'</td>
                 <td>'.$users_all['email'].'</td>';
                 
                 if($users_on['firm'] == 1) //firma
                 {
                    echo '<td>Ano</td>';
                 }elseif($users_on['firm'] == 0) //jednotlivec
                 {   
                    echo '<td>Ne</td>';
                 }
                 else
                 {  
                    echo '<td></td>';
                 }//tlacitko pro smazani
                  echo '<td>
                 	 	<form action="delete_user_admin.php" method="post" name="delete_user_admin onclick="return confirm("Are you sure you want to delete this item?");"">
                 	 		<input type="hidden"  name="usr" value="'.$users_all['email'].'"" />
                       	<input type="submit" name="btn_delete_user_admin" value="Odstranit" />
                      </form>
                    </td>';

              echo '</tr>';
    }
?>

<?php
    require_once("footer.php");
?>