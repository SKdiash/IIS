<?php
    
    header('Content-Type: text/html; charset=utf-8');

    $server = "localhost"; /* jmeno serveru */
    $username = "xleont01"; /* login do database */
    $password = "argoco3j"; /* heslo do database */
    $database = "xleont01"; /* jmeno database */

    // pripojeni ke database
    $mysqli = new mysqli($server, $username, $password, $database);

    // test zda jsme pripojili ke database
    if (mysqli_connect_errno()) {
        echo "<p><strong>Error1</strong>.: ".mysqli_connect_error()."</p>";
        exit();
    }

    // kodovani
    $mysqli->set_charset('utf8');

    // potrebujeme to podeji, aby uzivatel pri chybe mohl se vratit do hlavni stranky
    $address_site = "http://www.stud.fit.vutbr.cz/~xleont01/";
?>
