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
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Omlouv�me se, ale nastala chyba p�i zpracov�n� hesla. Zkuste je�t� jednou, pros�m.</p>";
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
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Omlouv�me se, ale nastala chyba p�i zm�n� hesla. Zkus'te je�t� jednou, pros�m.</p>";
    
                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/person_info.php");
    
                    exit();
                }else{
    
                    $_SESSION["success_messages"] = "<p class='success_message'>Gratulujeme! Zm�na hesla prob�hla �sp�n�.</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/person_info.php");
                }
                 
            } 
            else
            {
                $_SESSION["error_messages"] .= "<p class='mesage_error' >ERROR! Zadali jsi �patn� star� heslo. Zkuste je�t� jednou, pros�m.</p>";
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/person_info.php");
    
                exit();
            }  
              
        }
    }
    else{
        exit("<p><strong>Error!</strong> Nach�z�te jsi na �patn� str�nce. Po��d�me V�s, abyses vr�tili na <a href=".$address_site.">hlavn� str�nku</a>. D�kujeme.</p>");
    }


?>