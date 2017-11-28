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
    /* PRIDAT NORMALNI ERROR< POKUD UZIVATEL ZADAL SPATNE PREDCHOZI HESLO*/
    
    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
    
    if(isset($_POST["btn_delete_user"]))//zmacknute tlacitko smazat
    { 
        $email = $_SESSION['email'];//email uzivatele
        $select =  $mysqli->query("SELECT * FROM users WHERE email = '".$email."'");
        $row_mem = $select->fetch_assoc();

        if($row_mem['firm'] == 0){//jednotlivec
            //vybrat id konk.kurzu kde je uzivatel zaregistrovan
            $select_course = $mysqli->query("SELECT id_l_course FROM member_of_course WHERE id_member = '".$row_mem['id']."'");

           for($i = 1; $i <= ($select_course->num_rows); $i++){
                $row_course= $select_course->fetch_assoc(); //snizit pocet ucastniku v konkretnim kurzu
                $log_course = $mysqli->query("UPDATE `listed_course` SET number_logged=number_logged-1 WHERE id = '".$row_course['id_l_course']."'");
            }
        
            $delete_mem = $mysqli->query("DELETE FROM member_of_course WHERE id_member = '".$row_mem['id']."'");//smazat z tabulky ucastniku u konk. kurzu
        }
        if($row_mem['firm'] == 1) {//firma
             //smazat objednavky uzivatele
            $delete_order = $mysqli->query("DELETE FROM `order` WHERE id_firm = '".$row_mem['id']."'");

        }

        $delete = $mysqli->query("DELETE FROM `users` WHERE email = '".$email."'");//smazat uzivatele - sam sebe
        if(!$delete){
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Nastala chyba pøi mazání úètu. Zkuste je¹tì jednou, prosím.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/person_info.php");

            exit();
        }else{
            
            $_SESSION["success_messages"] = "<p class='success_message'>Jste úspì¹nì smazal svùj úèet.</p>";

            // Vraceme uzivateli na hlavni stranku
            unset($_SESSION["email"]);
            unset($_SESSION["password"]);

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/index.php");
        } 
    }
    else{
        exit("<p><strong>Error!</strong> Nacházíte jsi na ¹patnì stránce. Po¾ádáme Vás, abyses vrátili na <a href=".$address_site.">hlavní stránku</a>. Dìkujeme.</p>");
    }

?>