<?php
    session_start();

    /* PRIDAT NORMALNI ERROR< POKUD UZIVATEL ZADAL SPATNE PREDCHOZI HESLO*/
    
    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
    
    if(isset($_POST["btn_delete_user"]))
    {

        $email = $_SESSION['email'];
        $delete = $mysqli->query("DELETE FROM `users` WHERE email = '".$email."'");
        if(!$delete){
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Error with delete</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/index.php");

            exit();
        }else{

            $_SESSION["success_messages"] = "<p class='success_message'>delete complete!!!e</p>";

            // Vraceme uzivateli na hlavni stranku
            unset($_SESSION["email"]);
            unset($_SESSION["password"]);

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/index.php");
        }
    }
    else{
        exit("<p><strong>Error!</strong> Wrong site5 <a href=".$address_site."> main page</a>.</p>");
    }


?>