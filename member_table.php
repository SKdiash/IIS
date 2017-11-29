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

<h2>Seznam účastníků</h2>

<?php
      
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';

    if(isset($_POST["btn_members"]))//vypsani uzivatelu konkretniho kurzu
    { 
        if(isset($_POST["course_name"])){

            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $mem = trim($_POST["course_name"]);

            // Test zda nemame prazdne pole
            if(!empty($mem)){
                // Pro bezpecnost prevadive do html formatu
                $mem = htmlspecialchars($mem, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Omlouváme se, ale nastala chyba při zpracování jména kurzu. Zkuste to znovu.</p>";
            }

        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Nebylo zadáno jméno kurzu, které chcete vyhledat. Zadajte ho, prosím.</p>";

        } 
        //konkretni kurz
        $list_member = $mysqli->query("SELECT * FROM `member_of_course` WHERE id_l_course = '".$mem."'"); 
        
        for($i = 1; $i <= ($list_member->num_rows); $i++)
        {  
            //clenove konkretniho kurzu - vypis
            $members = $list_member->fetch_assoc();
            $result = $mysqli->query("SELECT * FROM `users` WHERE id = '".$members['id_member']."' ");
            $mem_all = $result->fetch_assoc();
            echo '<td> '.$mem_all['first_name'].' '.$mem_all['last_name'].'</td>';//jmeno a prijmeni
        }
    }
?>

<?php
    require_once("footer.php");
?>