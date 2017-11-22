
<?php
/* TODO */
/* V CSS RESIT PROBLE S NAVIGACE!!! */
/* NEBO ZMENIT DIV NA LI_UL */
ini_set("default_charset", "UTF-8");
?>

<?php 
    session_start();           
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vector</title>    
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            "use strict";
            //================ Test zda spravne zadan email ==================

            //regularni vyrazy
            var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
            var mail = $('input[name=email]');

            mail.blur(function(){
                if(mail.val() != ''){

                    // Test zda email odpovida regularnymu vyrazu
                    if(mail.val().search(pattern) == 0){
                        // Mazeme zpravy o chybe
                        $('#valid_email_message').text('');

                        // Aktivujeme tlacitko na registrace
                        $('input[type=submit]').attr('disabled', false);
                    }else{
                        // Vypisujeme zpravy o chybe
                        $('#valid_email_message').text('Wrong Email1');

                        // Deaktivujeme tlacitko na registrace
                        $('input[type=submit]').attr('disabled', true);
                    }
                }else{
                    $('#valid_email_message').text('Enter 1 email');
                }
            });

            //================ Test zda heslo obsahuje vice nez 6 symbolu ==================
            var password = $('input[name=password]');

            password.blur(function(){
                if(password.val() != ''){

                    // Pokud heslo in nez 6 symbolu - chyba
                    if(password.val().length < 6){
                        // Vypisujeme zpravy o chybe
                        $('#valid_password_message').text('Min lenght is 6');

                        // Deaktivujeme tlacitko na registrace
                        $('input[type=submit]').attr('disabled', true);

                    }else{
                        // Mazeme zpravy o chybe 
                        $('#valid_password_message').text('');

                        // Aktivujeme tlacitko na registrace
                        $('input[type=submit]').attr('disabled', false);
                    }
                }else{
                    $('#valid_password_message').text('Enter 1 pass');
                }
            });
        });
    </script>
</head>
<body>

<div id="header">
  
    <h2>Softwarové kurzy</h2>
    <a href="index.php"><img src="pc.png" href="index.php" width="50" height="50" alt="pc"></a>

    <div id="auth_block"> 
            <div id="main">
                <a href="index.php">Hlavní stránka</a>
            </div>
    <?php
        // Test zda uzivvatel je prihlasen
        if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
            // Pokud ne, tak "kreslime" tlacitka Registrace a Prihlaseni
    ?>      
            
            <div id="link_info">
                <a href="kurs_info.php">Informace o kurzech</a>
            </div>
            
            <div id="link_register">
                <a href="form_register.php">Registrace</a>
            </div>
            
            <div id="link_auth">
                <a href="form_auth.php">Přihlášení</a>
            </div>
    <?php
        }else{
            // Pokud ano, tak "kreslime" tlacitka Vyhod
    ?>      
            <div id="person_area">
                <a href="person_area.php">Změny</a>
            </div>
            <div id="link_logout">
                <a href="logout.php">Odhlášení</a>
            </div>
    <?php
        }
    ?>
    </div>
     <div class="clear"></div>
</div>
