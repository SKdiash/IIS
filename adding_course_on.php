<?php
    session_start();
    require_once("dbconnect.php");

    // Deklarujeme promennou na zpravy chyb
    $_SESSION["error_messages"] = '';

    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
    
    if(isset($_POST["adding_course_on"]) && !empty($_POST["adding_course_on"])){
        if(isset($_POST["name_course_on"])){
                 
                // Pokud nekdo zadal mezery na zacatku a konce - smazeme
                $name = ($_POST["name_course_on"]);
          
                // Test zda nemame prazdne pole
                if(!empty($name)){
                    // Pro bezpecnost prevadive do html formatu
                    $name = htmlspecialchars($name, ENT_QUOTES);
                }else{
                    // Pokud se nastala chyba - ukladame to do promenne
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter name of course</p>";

                    // Vraceme uzivateli na hlavni stranku
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/course_on.php");

                    exit();
                }
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No name1</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_on.php");

                exit();
            }
            
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
                header("Location: ".$address_site."/course_on.php");
    
                exit();
            }
        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>No city1</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/course_on.php");

            exit();
        }

        if(isset($_POST["date"])){

            // Pokud nekdo zadal mezery na zacatku a konce - smazeme
            $date = trim($_POST["date"]);

            // Test zda nemame prazdne pole
            if(!empty($date)){
                // Pro bezpecnost prevadive do html formatu
                $date = htmlspecialchars($date, ENT_QUOTES);
            }else{
                // Pokud se nastala chyba - ukladame to do promenne
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Ukazte datum</p>";

                // Vraceme uzivateli na hlavni stranku
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/course_on.php");

                exit();
            }
        }else{
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error'>No date1</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/course_on.php");

            exit();
        }
        
        // Hledame id coursu   
        $resC = $mysqli->query("SELECT id_course FROM `course` WHERE name = '".$name."'");
        $idcourse = $resC->fetch_assoc();
        // Pridavame novy probihajici kurz  
        $result_query_insert = $mysqli->query("INSERT INTO `listed_course` ( `id_course`, `city`, `date`) VALUES ('".$idcourse['id_course']."', '".$city."', '".$date."');");
        
        if(!$result_query_insert){
            // Pokud se nastala chyba - ukladame to do promenne
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Error while adding course</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/course_on.php");

            exit();
        }else{

            $_SESSION["success_messages"] = "<p class='success_message'>Adding new course complete!</p>";

            // Vraceme uzivateli na hlavni stranku
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/course_on.php");
        }
            // Ukonceni prace
            $result_query_insert->close();

            // Zavirame database
            $mysqli->close();
    }else{
        exit("<p><strong>Error!</strong> Wrong site5 <a href=".$address_site."> main page</a>.</p>");
    }
    
    
?>