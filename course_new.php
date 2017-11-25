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

<div id="new_course">
    <h2>Přidání nového kurzu</h2>

    <form action="adding_new_course.php" method="post" name="adding_new_course" >
        <table>
            <tr>
                <td> Jméno kurzu: </td>
                <td>
                    <input type="text" name="name" required="required"/>
                </td>
            </tr>

            <tr>
                <td> Lektor: </td>
                <td>
                    <input type="text" name="lector" required="required" />
                </td>
            </tr>

            <tr>
                <td> Maximální kapacita: </td>
                <td>
                    <input type="text" name="max_capacity" required="required" />
                </td>
            </tr>
            <tr>
                <td> Cena pro jednotlivce: </td>
                <td>
                    <input type="text" name="price_one_person" required="required" />
                </td>
            </tr>
            <tr>
                <td> Cena pro firmu: </td>
                <td>
                    <input type="text" name="price_firm" required="required" />
                </td>
            </tr>
            <tr>
                <td> Náklady: </td>
                <td>
                    <input type="text" name="cost_minus" required="required" />
                </td>
            </tr>
            <tr>
                <td> Popis: </td>
                <td>
                    <textarea cols="30" rows="5" name="information" required=" "></textarea>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit_new_course" value="Přidat kurz!" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
    require_once("footer.php");
?>