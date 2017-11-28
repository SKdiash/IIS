<?php
    session_start();

    require_once("dbconnect.php");
    
    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';


    // Test zda uzivatel zmacknoul tlacitko prihlaseni
    // Pokud ano, tak prihlasujeme uzivateli do informacni systemy
    // Pokud ne, to znamena, ze uzivatel zkusil pristupit primo do stranky - chyba!
    if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){

        // Pokud nekdo zadal mezery na zacatku a konce - smazeme
        $email = trim($_POST["email"]);
            
        if(isset($_POST["email"])){
            if(!empty($email)){
                // Pro bezpecnost prevadive do html formatu
                $email = htmlspecialchars($email, ENT_QUOTES);

                // Regularni vyraz pro email adresu
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

                // Pokud zadany email neodpovida regularnimu vyrazu
                if( !preg_match($reg_email, $email)){
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Nevalidní e-mail.</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_auth.php");

                    exit();
                }
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Prázdný e-mail.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                exit();
            }
        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Nezadán e-mail.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");

            exit();
        }

        if(isset($_POST["password"])){

            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $password = trim($_POST["password"]);

            if(!empty($password)){
                // Pro bezpecnost prevadive do html formatu
                $password = htmlspecialchars($password, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Vložte heslo.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_auth.php");

                exit();
            }
        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Nezadáno heslo.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");

            exit();
        }

        // Dotaz na hledani uzivatelu v database
        $result_query_select = $mysqli->query("SELECT * FROM `users` WHERE email = '".$email."' AND password = '".$password."'");

        if(!$result_query_select){
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Chyba při vyhledání uživatele.</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_auth.php");

            exit();
        }else{

            // Pokud byl nalezen uzivatel
            if($result_query_select->num_rows == 1){

                // Zadana indormace odpobida informace v database
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/index.php");

            }else{

                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Špatný e-mail nebo heslo.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_auth.php");

                exit();
            }
        }
    }else{
       exit("<p><strong>Chyba!</strong> Špatná stránka <a href=".$address_site."> hlavní stránka</a>.</p>");
    }
