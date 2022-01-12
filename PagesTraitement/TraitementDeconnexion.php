<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
            <meta charset="utf-8" />
    </head>
    <body>
    <?php
            try
            {
                $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
            }
            catch(Exception $e)
            {
    
                    die('Erreur : '.$e->getMessage());
            }
            $_SESSION = array();
            session_destroy();
            header('Location: ../index.php');
            exit();
            ?>
       
            </body>
</html>