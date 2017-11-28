<?php
    require_once("header.php");
    
    /* TODO TLACITKA ODSTRANIT KURZ, PRIHLASIT SE, PRIDAT KURZ*/
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

<?php
    require_once("person_area.php");
?>

<h2>Seznamy účastníků ve kurzech</h2>
<?php
  
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';
      
    $list_course = $mysqli->query("SELECT * FROM `listed_course`"); // zjistime kolik ted probiha kurzu
    //echo $list_course->num_rows;
    
    for($i = 1; $i <= ($list_course->num_rows); $i++)
    {  
          
          $course_on = $list_course->fetch_assoc();
          $result = $mysqli->query("SELECT * FROM `course`, `listed_course` WHERE listed_course.id = '".$course_on['id']."' AND course.id_course = listed_course.id_course");
          $course_all = $result->fetch_assoc();
          if($course_on['number_logged']>0)
              echo '<form action="member_table.php" method="post" name="member_table">
                        <input type="hidden"  name="course_name" value="'.$course_on['id'].'"" />
                        <input type="submit" name="btn_members" value="'.$course_all['name']."\tod ".$course_on['date'].'" />
                    </form>';
    }

                      
?>



<?php
    require_once("footer.php");
?>