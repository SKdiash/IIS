
<?php
/* TODO */
/* COOKIES!!! ABY BYLO MOZNE AUTOMATICKE ODHLASOVANI (PODIAT SE DO OSTATNICH SOUBORU. NEKDY BUDE TAKY NUTNE UDELAT ZMENY) */
?>

<?php
    session_start();

    unset($_SESSION["email"]);
    unset($_SESSION["password"]);
    
    // Vratime se na tu stranky, se ktere uzivatel zmacknoul "Exit"
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: index.php");
?>