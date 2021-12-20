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
            if (isset($_POST['MotDePasse']) && isset($_POST['Email']))
            {
                $reponse = $bdd->prepare('SELECT* FROM personne WHERE AdresseMail=?');
                $reponse->execute(array($_POST['Email']));
                $donnee =$reponse->fetch();
                $_SESSION['id'] = $donnee['IdPersonne'];
                $_SESSION['log'] = "oui";
                if (!$donnee)
                {
                    header('Location: PageConnexion.php');
                    exit();
                }
                else if (password_verify($_POST['MotDePasse'],$donnee['MotDePasse'])==True)
                {
                    header('Location: ../PagesPrincipales/PagePrincipale.php');
                    exit();
                }
                else
                {
                    header('Location: ../PagesPrincipales/PageConnexion.php');
                    exit();
                }
            }
            ?>
       
            </body>
</html>