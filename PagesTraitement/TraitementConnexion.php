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
        try {
            $bdd = new PDO('mysql:host=projetevenement.mysql.database.azure.com;dbname=projetevenement', 'nono', 'Fbq6dwab678?!');
        }
        catch (PDOException $e) {
            print("Error connecting to SQL Server.");
            die(print_r($e));
        }
        if (isset($_POST['MotDePasse']) && isset($_POST['Email']))
            {
                $reponse = $bdd->prepare('SELECT* FROM personne WHERE AdresseMail=?');
                $reponse->execute(array($_POST['Email']));
                $donnee =$reponse->fetch();
                
                if (!$donnee)
                {
                    echo "<script type='text/javascript'>document.location.replace('https://projetevenements.azurewebsites.net/PagesPrincipales/PageConnexion.php');</script>";
                    exit();
                }
                else if (password_verify($_POST['MotDePasse'],$donnee['MotDePasse'])==True)
                {
                    $_SESSION['id'] = $donnee['IdPersonne'];
                    $_SESSION['log'] = "oui";
                    echo "<script type='text/javascript'>document.location.replace('https://projetevenements.azurewebsites.net/index.php');</script>";
                    exit();
                }
                else
                {
                    echo "<script type='text/javascript'>document.location.replace('https://projetevenements.azurewebsites.net/PagesPrincipales/PageConnexion.php');</script>";
                    exit();
                }
                
         
            }
        
            ?>
       
            </body>
</html>
