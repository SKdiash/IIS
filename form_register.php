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
    // Test zda uzivatel jiz registrovan
    // pokud ne - otevri se menu registrace
    // pokud ano - vypisi zprava
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>
<div id="form_register">
    <h2>Registration form</h2>

    <form action="register.php" method="post" name="form_register" >
        <table>
            <tr>
                <td> Name: </td>
                <td>
                    <input type="text" name="first_name" required="required"/>
                </td>
            </tr>

            <tr>
                <td> Last Name: </td>
                <td>
                    <input type="text" name="last_name" required="required" />
                </td>
            </tr>

            <tr>
                <td> Email: </td>
                <td>
                    <input type="email" name="email" required="required" /><br />
                    <span id="valid_email_message" class="mesage_error"></span>
                </td>
            </tr>

            <tr>
                <td> Password: </td>
                <td>
                    <input type="password" name="password" placeholder="min. 6" required="required" /><br />
                    <span id="valid_password_message" class="mesage_error"></span>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit_register" value="Registrate!" />
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
    }else{
?>
    <div id="authorized">
        <h2>You are already authorized2</h2>
    </div>

<?php
    }

    require_once("footer.php");
?>
