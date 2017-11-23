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

<?php


echo '<table border="1" cellpadding="5" cellspacing="2" summary="Probihajici kurzy" id="Table2">
   <tbody>
      <tr>
         <th colspan="5" scope="colgroup">Probihajici kurzy</th>
      </tr>
      <tr>
         <th scope="col" abbr="Name">Jmeno kurzu</th>
         <th scope="col" abbr="Tutor">Pocet ucastniku</th>
         <th scope="col">Mesto</th>
         <th scope="col">Datum</th>
         <th scope="col">Funkce</th>
      </tr>';
      
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';

    // Abychom dozvedeli kdo je uzivatel, potrebujeme to pozdeji
    $email = $_SESSION['email'];
    $result = $mysqli->query("SELECT firm FROM `users` WHERE email = '".$email."'");
    $user = $result->fetch_assoc();
      
      
    $list_course = $mysqli->query("SELECT * FROM `listed_course`"); // zjistime kolik ted probiha kurzu
    //echo $list_course->num_rows;
    
    for($i = 1; $i <= ($list_course->num_rows); $i++)
    {  
          
          $course_on = $list_course->fetch_assoc();
          $result = $mysqli->query("SELECT * FROM `course`, `listed_course` WHERE listed_course.id = '".$course_on['id']."' AND course.id_course = listed_course.id_course");
          $course_all = $result->fetch_assoc();
          echo '<tr>
                   <td scope="row">'.$course_all['name'].'</td>
                   <td>'.$course_on['number_logged'].'/'.$course_all['max_capacity'].'</td>
                   <td>'.$course_on['city'].'</td>
                   <td>'.$course_on['date'].'</td>';
                   
                   if($user['firm'] == 3) //admin
                   {
                      echo '<td>
                          <input type="submit" name="btn_submit_delete_course" value="Odstranit kurz" />
                      </td>';
                   }elseif($user['firm'] == 0) //jednotlivec
                   {   
                      echo '<td>
                          <input type="submit" name="btn_submit_register_course" value="Prihlasit se" />
                      </td>';
                   }
                   else
                   {  
                      echo '<td></td>';
                   }
                echo '</tr>';
    }
    // pro uzivatele bych dala nejaky select from course where course.id = listed_course.id_course and listed_course.number_logged < course.max_cap

?>

<div id="adding_course_on">
    <h2>Pridani noveho kurzu</h2>

    <form action="adding_course_on.php" method="post" name="adding_course_on" >
        <table>
            <tr>
                <td> Kurz: </td>
                <td>
                    <select name="name_course_on" id="IDChut" required="required">
                       <?php 
                          
                          $all_course = $mysqli->query("SELECT name FROM `course`");
                          
                          for($d = 1; $d <= ($all_course->num_rows); $d++)
                          {
                            $course_are = $all_course->fetch_assoc();
                            
                            echo '<option value="'.$course_are['name'].'">'.$course_are['name'].'
                                </optionc>';
                          }
                       ?>
                    </select>
                    
                </td>
            </tr>

            <tr>
                <td> Mesto: </td>
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
                    <input type="submit" name="adding_course_on" value="Pridat kurz" />
                </td>
            </tr>
        </table>
    </form>
</div>   
 
<?php
    require_once("footer.php");
?>