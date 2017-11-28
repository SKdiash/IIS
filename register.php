<?php
    session_start();

    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';

    // Test zda uzivatel zmacknoul tlacitko registrace
    // Pokud ano, tak registrujeme uzivateli do database
    // Pokud ne, to znamena, ze uzivatel zkusil pristupit primo do stranky - chyba!
    if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){//tlacitko registrovat

           // Pokud bylo zadano jmeno, zapisime ho do promenne a kontrolujeme zda zadano zpravne
            if(isset($_POST["first_name"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $first_name = trim($_POST["first_name"]);

                // Test zda nemame prazdne pole
                if(!empty($first_name)){
                    // Pro bezpecnost prevadive do html formatu
                    $first_name = htmlspecialchars($first_name, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>�patn� jste nastavili vlastn� jm�no. Skuste je�t� jednou, pros�m.</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    exit();
                }

            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>�patn� jste nastavili vlastn� jm�no. Skuste je�t� jednou, pros�m.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                exit();
            }

            // Pokud bylo zadano prijmeni, zapisime ho do promenne a kontrolujeme zda zadano zpravne
            if(isset($_POST["last_name"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $last_name = trim($_POST["last_name"]);

                if(!empty($last_name)){
                    // Pro bezpecnost prevadive do html formatu
                    $last_name = htmlspecialchars($last_name, ENT_QUOTES);
                }else{

                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >�patn� jste nastavili p��jmen�. Skuste je�t� jednou, pros�m.</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    exit();
                }

            }else{

                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >�patn� jste nastavili p��jmen�. Skuste je�t� jednou, pros�m.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                exit();
            }

            // Pokud byl zadan email, zapisime ho do promenne a kontrolujeme zda zadan zpravne
            if(isset($_POST["email"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $email = trim($_POST["email"]);

                if(!empty($email)){

                    // Pro bezpecnost prevadive do html formatu
                    $email = htmlspecialchars($email, ENT_QUOTES);

                    // Regularni vyraz pro testovani email adresy
                    $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

                    // Pokud email neodpovida regularnemu vyrazu
                    if( !preg_match($reg_email, $email)){
                        // Pokud se nastala chyba - ukladame to do promenne
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >�patn� jste nastavili e-mail. Skuste je�t� jednou, pros�m.</p>";

                        // Vraceme uzivateli na hlavni stranku
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."/form_register.php");

                        exit();
                    }

                    // Kontrolujeme, zda email nebyl jiz zaregistrovan
                    $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

                    // Pokud byl nalezen uzivatel se stejnem emailem
                    if($result_query->num_rows == 1){

                        if(($row = $result_query->fetch_assoc()) != false){

                                // Pokud se nastala chyba - ukladame to do promenne
                                $_SESSION["error_messages"] .= "<p class='mesage_error' >��et se stejn�m e-mailem ji� existuje. Zkuste je�t� jednou, nebo obra�te se na admina.</p>";

                                // Vraceme uzivateli na hlavni stranku
                                header("HTTP/1.1 301 Moved Permanently");
                                header("Location: ".$address_site."/form_register.php");

                        }else{
                            // Pokud se nastala chyba - ukladame to do promenne
                            $_SESSION["error_messages"] .= "<p class='mesage_error' >Nastala chyba p�i ukl�d�n� informace o ��tu.</p>";

                            // Vraceme uzivateli na hlavni stranku
                            header("HTTP/1.1 301 Moved Permanently");
                            header("Location: ".$address_site."/form_register.php");
                        }

                        // zavirame promennou, abychom mohli ji vyuzit pozdeji 
                        $result_query->close();

                        exit();
                    }
                    // zavirame promennou, abychom mohli ji vyuzit pozdeji
                    $result_query->close();
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >�patn� jste nastavili e-mail. Skuste je�t� jednou, pros�m.</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    exit();
                }

            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >�patn� jste nastavili e-mail. Skuste je�t� jednou, pros�m.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                exit();
            }

            // Pokud bylo zadano heslo, zapisime ho do promenne a kontrolujeme zda zadano zpravne
            if(isset($_POST["password"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $password = trim($_POST["password"]);

                if(!empty($password)){
                    // Pro bezpecnost prevadive do html formatu
                    $password = htmlspecialchars($password, ENT_QUOTES);

                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >�patn� jste nastavili heslo. Skuste je�t� jednou, pros�m.</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_register.php");

                    exit();
                }

            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >�patn� jste nastavili heslo. Skuste je�t� jednou, pros�m.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                exit();
            }
            
            $subcheck = (isset($_POST['subcheck'])) ? 1 : 0;  // Pro rozliseni firmy od jednotlivce

            // Dotaz na pridani do database
            $result_query_insert = $mysqli->query("INSERT INTO `users` (first_name, last_name, email, password, firm) VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$password."', '".$subcheck."')");

            if(!$result_query_insert){
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Nastala chyba p�i ukl�d�n� informace o ��tu.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");

                exit();
            }else{

                $_SESSION["success_messages"] = "<p class='success_message'>Registrace prob�hla �sp�n�. <br />Ted m��ete p�ihl�sit se do syst�mu.</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_auth.php");
            }

            // Ukonceni prace
            $result_query_insert->close();

            // Zavirame database
            $mysqli->close();

    }else{
        exit("<p><strong>Error!</strong> Nach�z�te jsi na �patn� str�nce. Po��d�me V�s, abyses vr�tili na <a href=".$address_site.">hlavn� str�nku</a>. D�kujeme.</p>");
    }
?>