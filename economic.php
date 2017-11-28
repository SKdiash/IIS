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
    
    $_SESSION["error_messages"] = '';
    // Deklarujeme promennou na zpravy
    $_SESSION["success_messages"] = '';


echo '<table border="1" cellpadding="6" cellspacing="2" summary="Probíhající kurzy" id="Table2">
   <tbody>
      <tr>
         <th colspan="6" scope="colgroup">Náklady a zisky</th>
      </tr>
      <tr>
         <th scope="col" abbr="Name">Jméno kurzu</th>
         <th scope="col" abbr="Tutor">Počet účastníků</th>   
         <th scope="col">Datum</th>
         <th scope="col">Zisk</th>
         <th scope="col">Náklad</th>
         <th scope="col">Celkem</th>
      </tr>';
      

    $total = 0;  
      
    $list_course = $mysqli->query("SELECT * FROM `listed_course`"); // zjistime kolik ted probiha kurzu
    //echo $list_course->num_rows;
    
    for($i = 1; $i <= ($list_course->num_rows); $i++)
    {  
          
          $course_on = $list_course->fetch_assoc();
          $result = $mysqli->query("SELECT * FROM `course`, `listed_course` WHERE listed_course.id = '".$course_on['id']."' AND course.id_course = listed_course.id_course");
          $course_all = $result->fetch_assoc();
          
          $zisk = $course_all['number_logged'] * $course_all['price_person'];
          $celkem = $zisk - $course_all['cost_course'];
          $total = $total + $celkem;
          echo '<tr>
                   <td scope="row">'.$course_all['name'].'</td>
                   <td>'.$course_on['number_logged'].'/'.$course_all['max_capacity'].'</td>
                   <td>'.$course_all['date'].'</td>
                   <td>'.$zisk.'</td>
                   <td>'.$course_all['cost_course'].'</td>
                   <td>'.$celkem.'</td>';
                   

          echo '</tr>';  
      }
      
    $listed_order = $mysqli->query("SELECT * FROM `order` WHERE accept = 1"); // zjistime kolik ted probiha kurzu
    //echo $list_course->num_rows;
    for($j = 1; $j <= ($listed_order->num_rows); $j++)
    {  
          
          $order_accept = $listed_order->fetch_assoc();
          $result = $mysqli->query("SELECT * FROM `course`, `order` WHERE order.id = '".$order_accept['id']."' AND course.id_course = order.id_course");
          $order_all = $result->fetch_assoc();
          
          $zisk = $order_all['price_firm'];
          $celkem = $zisk - $order_all['cost_course'];
          $total = $total + $celkem;
          echo '<tr>
                   <td scope="row">'.$order_all['name'].'</td>
                   <td>'.$order_all['max_capacity'].'/'.$order_all['max_capacity'].'</td>
                   <td>'.$order_all['dates'].'</td>
                   <td>'.$zisk.'</td>
                   <td>'.$order_all['cost_course'].'</td>
                   <td>'.$celkem.'</td>';
                   

          echo '</tr>';                    
    }
          
          
        
    echo '<tr><td colspan="6" align="right">'.$total.'</td></tr>';
    // pro uzivatele bych dala nejaky select from course where course.id = listed_course.id_course and listed_course.number_logged < course.max_cap

?>

<?php
    require_once("footer.php");
?>