<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/PagePrincipale.css"/>
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
                $reponse = $bdd->query('SELECT img_id, img_type, img_blob FROM images');
                $reponse->execute(array( ));
                foreach ($reponse as $r) {
                    ?>

<img src="data:image/png;;charset=utf-8;base64,<?php echo base64_encode($r["img_blob"]); ?>" />
                   <?php

                }
                ?>

</body>
</html>