<?php
    require_once("header.php");
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
    echo '<h2>Seznam probíhajících kurzů</h2>
          <table border="1" cellpadding="5" cellspacing="2" summary="Probíhající kurzy" id="Table2">
          <tbody>
          <tr>
            <th colspan="5" scope="colgroup">Probíhající kurzy</th>
          </tr>
          <tr>
            <th scope="col" abbr="Name">Jméno kurzu</th>
            <th scope="col" abbr="Tutor">Počet účastníků</th>
            <th scope="col">Město</th>
            <th scope="col">Datum</th>
            <th scope="col">Funkce</th>
          </tr>';
      
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';

    // Abychom dozvedeli kdo je uzivatel, potrebujeme to pozdeji
    $email = $_SESSION['email'];
    $result = $mysqli->query("SELECT * FROM `users` WHERE email = '".$email."'");
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
                  <form action="delete_course_on.php" method="post" name="delete_course_on">
                      <input type="hidden"  name="course" value="'.$course_on['id'].'"" />
                      <input type="submit" name="btn_submit_delete_course" value="Odstranit kurz" />
                  </form>
                  </td>';
        }elseif($user['firm'] == 0) //jednotlivec
        {   
            $is_member = $mysqli->query("SELECT * FROM `member_of_course` WHERE id_l_course = '".$course_on['id']."' AND id_member = '".$user['id']."' ");
            $is_mem = $is_member->fetch_assoc();
            if($user['id'] == $is_mem['id_member'])
            {
                echo '<td>
	                    <form action="log_out_course.php" method="post" name="log_out_course">
	                        <input type="hidden"  name="course_log" value="'.$course_on['id'].'"" />
	                        <input type="hidden"  name="member_log" value="'.$user['id'].'"" />
	                        <input type="submit" name="btn_submit_logout_course" value="Odhlásit se" />
	                    </form>
	                    </td>';
            }
            elseif($course_on['number_logged'] < $course_all['max_capacity'])
            {
	              echo '<td>
	                    <form action="log_in_course.php" method="post" name="log_in_course">
	                       <input type="hidden"  name="course_log" value="'.$course_on['id'].'"" />
	                        <input type="hidden"  name="member_log" value="'.$user['id'].'"" />
	                        <input type="submit" name="btn_submit_register_course" value="Přihlásit se" />
	                    </form>
	                    </td>';
            }
        }
        else
        {  
            echo '<td></td>';
        }
        echo '</tr>';
    }
?>

<?php
  if($user['firm'] == 3) //admin
  { ?>
      <div id="adding_course_on">
            <form action="adding_course_on.php" method="post" name="adding_course_on" >
                <table>
                    <tr>
                    <td> Kurz: </td>
                    <td>
                    <select name="name_course_on" id="id_course" required="required">
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
                        <input type="submit" name="adding_course_on" value="Přidat kurz" />
                    </td>
                    </tr>
                </table>
            </form>
        </div>   
    <?php } ?>
    
<?php
    require_once("footer.php");
?>