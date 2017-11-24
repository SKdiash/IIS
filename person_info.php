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
    
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';

    $email = $_SESSION['email'];
    $result = $mysqli->query("SELECT * FROM `users` WHERE email = '".$email."'");
    $row = $result->fetch_assoc();
        
    echo '
    Osobne info:  <br/>  <p>
    Email: '.$row['email'].' <br/>
    Jmeno: '.$row['first_name'].' <br/>
    Prijmeni: '.$row['last_name'].' <br/> </p>';
?>

<form action="delete_user.php" method="post" name="delete_user" >
    <input type="submit" name="btn_delete_user" value="Smazat uživatele!" />
</form>

<h2>Změna hesla</h2>
<form action="change_pass.php" method="post" name="change_pass" >
<tr>
<td> Heslo:</td>
<td>
    <input type="password" name="old_password"/><br />
    <span id="valid_password_message" class="mesage_error"></span>
</td> 
</tr>

<tr>
<td> Nové heslo:</td>
<td>
    <input type="password" name="new_password" placeholder="min. 6"/><br />
    <span id="valid_password_message" class="mesage_error"></span>
</td>
<td colspan="2">
    <input type="submit" name="btn_submit_change" value="Změnit heslo!" />
</td>
</tr>
</form>


<?php
    require_once("footer.php");
?>