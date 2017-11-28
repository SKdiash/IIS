<?php
    session_start();
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
    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
    
    if(isset($_POST["btn_submit_delete_order"]))
    {
        if(isset($_POST["del"])){
            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $del = trim($_POST["del"]);

            // Test zda nemame prazdne pole
            if(!empty($del)){
                // Pro bezpecnost prevadive do html formatu
                $del = htmlspecialchars($del, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Nebylo zadano jm�no objednabky, kterou chcete vymazat. Zkuste je�t� jdnou, pros�m</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/look_order.php");

                exit();
            }
        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Nebylo zadano jm�no objednabky, kterou chcete vymazat. Zkuste je�t� jdnou, pros�m</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/look_order.php");

            exit();
        }

        $delet = $mysqli->query("DELETE FROM `order` WHERE id = '".$del."'");

        if(!$delet){
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Nastala chyba p�i maz�n� objedn�vky. Zkuste je�t� jdnou, pros�m</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/look_order.php");

            exit();
        }else{

            $_SESSION["success_messages"] = "<p class='success_message'>Maz�n� objedn�vky prob�hlo �sp�n�.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/look_order.php");
        }
        $delet->close();

        // Zavirame database
        $mysqli->close();
    }
    else
    {
        exit("<p><strong>Error!</strong> Nach�z�te jsi na �patn� str�nce. Po��d�me V�s, abyses vr�tili na <a href=".$address_site.">hlavn� str�nku</a>. D�kujeme.</p>");
    }
?>