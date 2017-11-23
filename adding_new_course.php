<?php
    session_start();

    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
    
    if(isset($_POST["btn_submit_new_course"]) && !empty($_POST["btn_submit_new_course"])){
        if(isset($_POST["name"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $name = trim($_POST["name"]);

                // Test zda nemame prazdne pole
                if(!empty($name)){
                    // Pro bezpecnost prevadive do html formatu
                    $name = htmlspecialchars($name, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your name</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_new.php");

                    exit();
                }


            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }
            
            ///////////////////////////////////
                if(isset($_POST["lector"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $lector = trim($_POST["lector"]);

                // Test zda nemame prazdne pole
                if(!empty($lector)){
                    // Pro bezpecnost prevadive do html formatu
                    $lector = htmlspecialchars($lector, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your name</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_new.php");

                    exit();
                }


            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }
            ///////////////////////////////////
                    if(isset($_POST["max_capacity"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $max_capacity = trim($_POST["max_capacity"]);

                // Test zda nemame prazdne pole
                if(!empty($max_capacity) && is_numeric($max_capacity)){
                    // Pro bezpecnost prevadive do html formatu
                    $max_capacity = htmlspecialchars($max_capacity, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Pocet musi byt cislicovy</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_new.php");

                    exit();
                }


            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }
            /////////////////
                    if(isset($_POST["price_one_person"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $price_one_person = trim($_POST["price_one_person"]);

                // Test zda nemame prazdne pole
                if(!empty($price_one_person) && is_numeric($price_one_person)){
                    // Pro bezpecnost prevadive do html formatu
                    $price_one_person = htmlspecialchars($price_one_person, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Cena pro jednotlivca. musi byt cilslo</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_new.php");

                    exit();
                }


            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }
            //////////////////////
                    if(isset($_POST["price_firm"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $price_firm = trim($_POST["price_firm"]);

                // Test zda nemame prazdne pole
                if(!empty($price_firm) && is_numeric($price_firm)){
                    // Pro bezpecnost prevadive do html formatu
                    $price_firm = htmlspecialchars($price_firm, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Cena pro firmu. musi byt cislo</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_new.php");

                    exit();
                }


            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }
            ////////////////////////
                    if(isset($_POST["cost_minus"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $cost_minus = trim($_POST["cost_minus"]);

                // Test zda nemame prazdne pole
                if(!empty($cost_minus) && is_numeric($cost_minus)){
                    // Pro bezpecnost prevadive do html formatu
                    $cost_minus = htmlspecialchars($cost_minus, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Naklad musi byt cislicovy</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_new.php");

                    exit();
                }


            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }
            /////////////////////////
                    if(isset($_POST["information"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $information = trim($_POST["information"]);

                // Test zda nemame prazdne pole
                if(!empty($information)){
                    // Pro bezpecnost prevadive do html formatu
                    $information = htmlspecialchars($information, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your name</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_new.php");

                    exit();
                }


            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }
           ///////////////////////
           /* SELECT!!!!! */
           $result_query_insert = $mysqli->query("INSERT INTO `course` (name, lector, max_capacity, price_person, price_firm, cost_course, information) VALUES ('".$name."', '".$lector."', '".$max_capacity."', '".$price_one_person."', '".$price_firm."', '".$cost_minus."', '".$information."')");

            if(!$result_query_insert){
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Error while adding course</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");

                exit();
            }else{

                $_SESSION["success_messages"] = "<p class='success_message'>Adding new course complete!</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_new.php");
            }

            // Ukonceni prace
            $result_query_insert->close();

            // Zavirame database
            $mysqli->close();
    }else{

        exit("<p><strong>Error!</strong> Wrong site5 <a href=".$address_site."> main page</a>.</p>");
    }
    
    
?>