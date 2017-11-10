<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vector</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/styles.css">
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
    <h2>Just a header</h2>

    <a href="index.php">Main</a>

    <div id="auth_block">
    <?php
        // Test zda uzivvatel je prihlasen
        if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
            // Pokud ne, tak "kreslime" tlacitka Registrace a Prihlaseni
    ?>
            <div id="link_register">
                <a href="form_register.php">Registration</a>
            </div>

            <div id="link_auth">
                <a href="form_auth.php">Log in</a>
            </div>
    <?php
        }else{
            // Pokud ano, tak "kreslime" tlacitka Vyhod
    ?>
            <div id="link_logout">
                <a href="logout.php">Exit</a>
            </div>
    <?php
        }
    ?>
    </div>
     <div class="clear"></div>
</div>

