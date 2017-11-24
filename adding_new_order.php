<?php
    session_start();

    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
    
    if(isset($_POST["btn_submit_new_order"]) && !empty($_POST["btn_submit_new_order"])){

                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
        if(isset($_POST["name"])){

            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $name = trim($_POST["name"]);

            // Test zda nemame prazdne pole
            if(!empty($name)){
                // Pro bezpecnost prevadive do html formatu
                $name = htmlspecialchars($name, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter course name</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/make_order.php");

                exit();
            }


        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/make_order.php");

            exit();
        }

        ////////////////////////mesto
        if(isset($_POST["city"])){

            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $city = trim($_POST["city"]);

            // Test zda nemame prazdne pole
            if(!empty($city)){
                // Pro bezpecnost prevadive do html formatu
                $city = htmlspecialchars($city, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter city</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/make_order.php");

                exit();
            }


        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>No city</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/make_order.php");

            exit();
        }

            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
        if(isset($_POST["date"])){

            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $date = trim($_POST["date"]);

            // Test zda nemame prazdne pole
            if(!empty($date)){
                // Pro bezpecnost prevadive do html formatu
                $date = htmlspecialchars($date, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter date</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/make_order.php");

                exit();
            }


        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>No date</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/make_order.php");

            exit();
        }

        
        ///////////////////////////////////
          
       ///////////////////////
       /* SELECT!!!!! */
       $email = $_SESSION['email'];
        $resultUs = $mysqli->query("SELECT id FROM `users` WHERE email = '".$email."'");
        $user = $resultUs->fetch_assoc();
        
       $resC = $mysqli->query("SELECT id_course FROM `course` WHERE name = '".$name."'");

       $id_course = $resC->fetch_assoc();


       $result_query_insert = $mysqli->query("INSERT INTO `order` (id_course, id_firm, city, dates) VALUES ('".$id_course['id_course']."', '".$user['id']."', '".$city."', '".$date."')");

        if(!$result_query_insert){
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Error while adding order</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/make_order.php");

            exit();
        }else{

            $_SESSION["success_messages"] = "<p class='success_message'>Adding new order complete!</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/make_order.php");
        }

        // Ukonceni prace
        $result_query_insert->close();

        // Zavirame database
        $mysqli->close();
    }else{

        exit("<p><strong>Error!</strong> Wrong site5 <a href=".$address_site."> main page</a>.</p>");
    }

?>