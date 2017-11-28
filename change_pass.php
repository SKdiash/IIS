<?php
    session_start();

    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
    
    
    if(isset($_POST["btn_submit_change"]) && !empty($_POST["btn_submit_change"]))
    {   
        if(isset($_POST["old_password"]) && isset($_POST["new_password"]))
        {   
            $old_password = trim($_POST["old_password"]);
            $new_password = trim($_POST["new_password"]);
            
            if(!empty($old_password) && !empty($new_password)){
                // Pro bezpecnost prevadive do html formatu
                $old_password = htmlspecialchars($old_password, ENT_QUOTES);
                    
                $new_password = htmlspecialchars($new_password, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Omlouváme se, ale nastala chyba při zpracování hesla. Zkuste to ještě jednou, prosím.</p>";
            }
            
            $email = $_SESSION['email'];
            $result = $mysqli->query("SELECT * FROM `users` WHERE email = '".$email."'");
            $row = $result->fetch_assoc();
            if($row['password'] == $old_password)
            {
                $changes = $mysqli->query("UPDATE `users` SET password='$new_password' WHERE email = '".$email."'");
     
                // Dotaz na pridani do database
                if(!$changes){
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Omlouváme se, ale nastala chyba při změně hesla. Zkuste ještě jednou, prosím.</p>";
    
                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/person_info.php");
    
                    exit();
                }else{
    
                    $_SESSION["success_messages"] = "<p class='success_message'>Změna hesla proběhla úspěšně.</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/person_info.php");
                }
                 
            } 
            else
            {
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Chyba! Zadali jste špatně staré heslo.</p>";
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/person_info.php");
    
                exit();
            }  
              
        }
    }
    else{
       exit("<p><strong>Error!</strong> Nacházíte se na špatné stránce. Vráťe se na <a href=".$address_site.">hlavní stránku</a>.</p>");
    }


?>