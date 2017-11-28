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
    
    if(isset($_POST["btn_submit_delete_course"]))
    {
        if(isset($_POST["course"])){
            
            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $course = trim($_POST["course"]);

            // Test zda nemame prazdne pole
            if(!empty($course)){
                // Pro bezpecnost prevadive do html formatu
                $course = htmlspecialchars($course, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Nastala chyba při mazání probíhajícího kurzu.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_on.php");

                exit();
            }

        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Nastala chyba při mazání probíhajícího kurzu.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/course_on.php");

            exit();
        }
          
        $delete = $mysqli->query("DELETE FROM `listed_course` WHERE id = '".$course."'");
        if(!$delete){
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Nastala chyba při mazání probíhajícího kurzu.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/course_on.php");

            exit();
        }else{
            $_SESSION["success_messages"] = "<p class='success_message'>Probíhající kurz smazán.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/course_on.php");
        }
        
        $delete->close();
        // Zavirame database
        $mysqli->close();
    }
    else
    {
        exit("<p><strong>Error!</strong> Nacházíte jsi na špatné stránce. Vráťte se na <a href=".$address_site.">hlavní stránku</a>.</p>");
    }  

?>