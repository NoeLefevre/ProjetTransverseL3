<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
            try
            {
                $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
            }
            catch(Exception $e)
            {
    
                    die('Erreur : '.$e->getMessage());
            }
            if ($_GET['note']==0){
                ob_start();
                header("Location: ../PagesPrincipales/PageEvenement.php?id=".$_GET['event']."&false=1");
                exit();
            }
            else{
                $req = $bdd->prepare('INSERT INTO noteevenement(Note,IdEvenement,IdPersonne) 
                VALUES(:note,:ide,:idp)');
                $req->execute([
                'note' => $_GET['note'],
                'ide' => $_GET['event'],
                'idp' => $_SESSION['id'],
          ]);
                $reponse = $bdd->prepare('SELECT AVG(Note) as moynote from noteevenement WHERE IdEvenement=?');
                $reponse->execute(array($_GET['event']));
                $donnee =$reponse->fetch();
                $req = $bdd->prepare('UPDATE evenement SET MoyNote=:moynote WHERE IdEvenement=:ide');
                $req->execute([
                'moynote' => $donnee['moynote'],
                'ide' => $_GET['event'],
          ]);
          ob_start();
          header("Location: ../PagesPrincipales/PageEvenement.php?id=".$_GET['event']."&reset=1");
          exit();
            }

