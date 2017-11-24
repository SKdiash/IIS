<?php
    require_once("header.php");
?>

<?php
    require_once("person_area.php");
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

<div id="new_order">
    <h2>Vytvořit novou objednávku</h2>

    <form action="adding_new_order.php" method="post" name="adding_new_order" >
        <table>
            <tr>
                <td> Jméno kurzu: </td>
                <td>
                    <select name="name" required="required">
                       <?php 
                          
                          $all_course = $mysqli->query("SELECT name,price_firm FROM `course`");
                          
                          for($d = 1; $d <= ($all_course->num_rows); $d++)
                          {
                            $course_are = $all_course->fetch_assoc();
                            
                            echo '<option value="'.$course_are['name'].'">'.$course_are['name'].', '.$course_are['price_firm'].' Kč </optionc>';
                          }
                       ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td> Město: </td>
                <td>
                    <input type="text" name="city" required="required" />
                </td>
            </tr>

            <tr>
                <td> Datum: </td>
                <td>
                    <input type="date" name="date" required="required" />
                </td>
            </tr>
 
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit_new_order" value="Odeslat objednávku!" />
                </td>
            </tr>
        </table>
    </form>
</div>






<?php
    require_once("footer.php");
?>