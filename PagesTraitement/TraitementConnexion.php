<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<?php
        try {
            $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
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
                    ob_start();
                    header('Location: ../PagesPrincipales/PageConnexion.php');
                    exit();
                }
                else if (password_verify($_POST['MotDePasse'],$donnee['MotDePasse'])==True)
                {
                    $_SESSION['id'] = $donnee['IdPersonne'];
                    $_SESSION['log'] = "oui";
                    ob_start();
                    header('Location: ../index.php');
                    exit();
                }
                else
                {
                    ob_start();
                    header('Location: ../PagesPrincipales/PageConnexion.php');
                    exit();
                }
                
         
            }
            else{
                ob_start();
                header('Location: ../PagesPrincipales/PageConnexion.php');
                    exit();
            }
?>
